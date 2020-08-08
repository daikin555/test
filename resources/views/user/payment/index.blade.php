@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">決済・確認画面</div>
					<div class="panel-body">

						<!-- フラッシュメッセージ -->
						@if (session('index_message'))
						<div class="flash_message">
							<font color="red">
							{{ session('index_message') }}
							</font>
						</div>
						@endif

						商品の確認
						<table border='1'>
							<tr>
							<th>
							商品名
							</th>
							<th>
							個数
							</th>
							<th>
							金額
							</th>
							</tr>
							<tr>
							@foreach ($carts as $cart)
							<td>
							{{ $cart->item->name }}
							</td>
							<td>
							{{ $cart->stock }}
							</td>
							<td>
							{{ $cart->subtotal() }}
							</td>
							</tr>
							<tr>
							@endforeach
							<th>
							合計
							</th>
							<td>
							{{ $stocktotals }}
							</td>
							<td>
							{{ $totals }}
							</td>
							</tr>
						</table>
						<p><a href="{{ route('cart.add') }}">商品編集へ戻る</a></p>

						お届け先の確認
						<table border='1'>
							<tr>
							<td>
							{{ $delivery->md5 }}
							</td>
							</tr>
						</table>

						<p><a href="{{ route('address.index') }}">お届け先を変更する</a></p>

						<form id="app" action="{{ route('charge') }}" method="POST">
							{{ csrf_field() }}
							<a class="btn btn-primary" href="{{ route('address.index') }}">戻る</a>
							<script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
								data-key="{{ env('STRIPE_PUBLIC_KEY') }}"
								data-amount="{{ $totals }}"
								data-name="決済確認画面"
								data-label="決済をする"
								data-description="Online course about integrating Stripe"
								data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
								data-locale="auto"
								data-zip-code="false"
								data-currency="JPY"
								data-email="{{ Auth::user()->email }}">
							</script>
						</form>
						</body>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
