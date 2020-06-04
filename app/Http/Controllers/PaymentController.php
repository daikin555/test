<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\facades\Auth;
use App\Address;
use App\Cart;
use App\Item;
use App\Payment;
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
		/*\Stripe\Stripe::setApiKey('sk_test_4eC39HqLyjWDarjtT1zdp7dc');

		$session = \Stripe\Checkout\Session::create([
			'payment_method_types' => ['card'],
			'line_items' => [[
				'name' => "Cucumber from Roger's Farm",
				'amount' => 200,
				'currency' => 'usd',
				'quantity' => 10,
			]],
			'payment_intent_data' => [
				'application_fee_amount' => 200,
			],
			'success_url' => 'https://procir-study.site//itou175/laravel/public/stripe',
			'cancel_url' => 'https://procir-study.site//itou175/laravel/public/stripe',
		], [
			'stripe_account' => '{{CONNECTED_STRIPE_ACCOUNT_ID}}',
		]);

		return (route('stripe'));*/
		try {
			Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

			$customer = \Stripe\Customer::create(array(
				'email' => $request->stripeEmail,
				'source' => $request->stripeToken
			));

			$charge = \Stripe\Charge::create(array(
				'customer' => $customer->id,
				'amount' => 1000,
				'currency' => 'jpy'
			));

			return (route('stripe'));
		} catch (\Exception $ex) {
			return $ex->getMessage();
		}
	}

}
