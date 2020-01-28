@extends('layouts.app_admin')

@section('content')
<div class="container">
<div class="row">
<div class="col-md-8 col-md-offset-2">
<div class="panel panel-default">
<div class="panel-heading">商品追加</div>
<div class="panel-body">

<a href="{{ route('items.index') }}">商品一覧へ</a>
{{ Form::open('route' => 'items.add') }}
{{ Form::text('商品名') }}
{{ Form::textarea('商品説明') }}
{{ Form::text('在庫') }}
{{ Form::text('値段') }}
{{ Form::close('商品追加') }}
</div>
</div>
</div>
</div>
</div>
</div>

	<a href="{{ route('items.item_name', ['id' => $item->id]) }}">{{ $item->item_name }}</a>

@endsection
