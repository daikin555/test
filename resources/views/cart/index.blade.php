@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
<div class="col-md-8 col-md-offset-2">
<div class="panel panel-default">
<div class="panel-heading">カート内容</div>
<div class="panel-body">

@if (0 < $carts->count())
	<table>
	<th>商品名</th>
	<th>購入数</th>
	<th>価格</th>
	<th>削除</th>
	</tr>
	@foreach ($carts as $cart)
		<td align="right">{{ $cart->item->name }}</td>
		<td align="right">{{ $cart->stock }}</td>
		<td align="right">{{ $cart->subtotal() }}</td>
		<td>{{ Form::open('route' => 'cart.delete') }}
		{{ csrf_field() }}
		{{ Form::hidden('cart_id', $cart->id) }}
		{{ Form::submit('削除') }}
		</form></td></tr>
	@endforeach
	<td>合計</td>
	<td>{{ $subtotals }}</td>
	<td>税込: {{ $totals }}</td>
	<td></td>
	</td>
	</table>
@else
	<h1>カートに商品はありません</h1>
@endif
<br>
<h2><a href="{{ route('items.index') }}">商品一覧へ戻る</a></h2>
</body>

@endforeach
</div>
</div>
</div>
</div>
</div>
</div>
@endsection
