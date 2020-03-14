@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
<div class="col-md-8 col-md-offset-2">
<div class="panel panel-default">
<div class="panel-heading">カート内容</div>
<div class="panel-body">

<!-- フラッシュメッセージ -->
@if (session('del_message'))
	<div class="flash_message">
	<font color="red">
	{{ session('del_message') }}
	</font>
	</div>
@endif
@if (session('add_message'))
	<div class="flash_message">
	<font color="red">
	{{ session('add_message') }}
	</font>
	</div>
@endif
@if (0 < $carts->count())
	<table border='2'>
	<tr>
	<th>商品名</th>
	<th>購入数</th>
	<th>価格</th>
	<th>削除</th>
	</tr>
	@foreach ($carts as $cart)
		<tr>
		<td align="right">{{ $cart->item->name }}</td>
		<td align="right">{{ $cart->stock }}</td>
		<td align="right">{{ $cart->subtotal() }}</td>
		<td>
		{{ Form::open(['route' => 'cart.delete']) }}
		{{ csrf_field() }}
		{{ Form::hidden('cart_id', $cart->id) }}
		{{ Form::submit('削除') }}
		{{ Form::close() }}
		</td></tr>
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
<p><a href="{{ route('address.index') }}">お届け先選択</a></p>
<p><a href="{{ route('item.index') }}">商品一覧へ戻る</a></p>
</body>

</div>
</div>
</div>
</div>
</div>
</div>
@endsection
