@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
<div class="col-md-8 col-md-offset-2">
<div class="panel panel-default">
<div class="panel-heading">商品一覧</div>

<div class="panel-body">
購入日：{{ $date }}
<table border='2'>
<tr>
<td>商品名</td>
<td>金額</td>
<td>個数</td>
</tr>

@foreach ($items as $item)
@foreach ($carts as $cart)
	<tr>
	<td>
	{{ $item->name }}
	</td>
	<td>{{ $item->price }}</td>
	<td>
	{{ $cart->stock }}
	</td>
	</tr>
@endforeach
@endforeach
</table>
<a href="{{ route('user.purchase') }}">戻る</a>

</div>
</div>
</div>
</div>
</div>
</div>
@endsection
