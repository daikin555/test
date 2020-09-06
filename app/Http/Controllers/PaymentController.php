<?php
namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\facades\Auth;
use App\Address;
use App\Cart;
use App\Item;
use App\Payment;
use App\Purchase;
use Stripe\Stripe;
use Stripe\Token;
use Stripe\Charge;

class PaymentController extends Controller {

	public function index(Request $request) {
		$delivery = Address::find($request->delivery);
		$carts = (new Cart)->all_get(Auth::id());
		$stocktotals = (new Payment)->stockAllSum(Auth::id());
		$totals = $this->totals($carts);
		if (is_null($carts)) {
			abort(404);
		}

		return view('user.payment.index', compact('carts', 'totals', 'stocktotals', 'delivery'));
	}

	private function subtotals($carts) {
		$result = 0;
		foreach ($carts as $cart) {
			$result += $cart->subtotal();
		}
		return $result;
	}

	private function totals($carts) {
		$result = $this->subtotals($carts) + $this->tax($carts);
		return $result;
	}

	private function tax($carts) {
		$result = floor($this->subtotals($carts) * 0.1);
		return $result;
	}

	public function charge(Request $request) {
		$carts = (new Cart)->all_get(Auth::id());
		$stocktotal = (new Payment)->stockAllSum(Auth::id());
		if ($stocktotal == 0) {
			return redirect()->route('cart.index')->with('add_message', 'カートの中身が空です！決済は中断されました。');
		}
		$totals = $this->totals($carts);
		$chargeId = null;
		try {
			Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

			$customer = \Stripe\Customer::create(array(
				'email' => $request->stripeEmail,
				'source' => $request->stripeToken
			));

			$charge = \Stripe\Charge::create(array(
				'customer' => $customer->id,
				'amount' => $totals,
				'currency' => 'jpy',
			));
			$chargeId = $charge->id;
			DB::beginTransaction();
			$payment = (new Payment)->purchaseData(Auth::id(), $request->address, $chargeId, $totals);
			foreach ($carts as $cart) {
				(new Purchase)->purchased($cart->id, $payment->id);
				(new Cart)->itemDeleted($cart->id);
			}
			DB::commit();
			return redirect()->route('item.index');
		} catch (\Exception $ex) {
			DB::rollback();
			if ($chargeId !== null) {
				\Stripe\Refund::create(array(
					'charge' => $chargeId,
				));
			}
			return $ex->getMessage();
		}
	}

}
