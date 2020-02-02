@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
<div class="col-md-8 col-md-offset-2">
<div class="panel panel-default">
<div class="panel-heading">商品一覧</div>

<div class="panel-body">
<table border='2'>
<tr>
<td>商品</td>
<td>値段</td>
<td>在庫</td>
</tr>
@foreach ($items as $item)
	<tr>
	<td>
	<a href="{{ route('item.name', ['id' => $item->id]) }}">{{ $item->name }}</a>
	</td>
	<td>{{ $item->price }}</td>
	<td>
	@if ($item->stock == 0)
		在庫なし
	@else
		在庫あり
	@endif
	</td>
	</tr>
@endforeach
</div>
</div>
</div>
</div>
</div>
</div>
@endsection
