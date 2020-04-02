@extends('layouts.app_admin')

@section('content')
<div class="container">
<div class="row">
<div class="col-md-8 col-md-offset-2">
<div class="panel panel-default">
<div class="panel-heading">商品詳細</div>
<div class="panel-body">
<!-- フラッシュメッセージ -->
@if (session('edit_message'))
	<div class="flash_message">
	{{ session('edit_message') }}
	</div>
@endif
<a href="{{ route('items.index') }}">商品一覧へ</a>
<br>
商品画像<br>
@if ($item->image == NULL)
画像なし
@else
<img src="{{ asset('/storage/image/'.$item->image) }}" width="200" height="200">
@endif
<br>
商品名<br>
{{ $item->name }}<br>
商品説明<br>
{{ $item->descrip }}<br>
価格<br>
{{ $item->price }}円<br>
在庫の有無<br>
@if ($item->stock == 0)
	在庫なし
@else
	在庫あり
@endif
<br>
<a href="{{ route('items.edit') }}">商品編集</a>
</div>
</div>
</div>
</div>
</div>
</div>
@endsection
