@extends('layouts.app_admin')
@section('content')
商品名<br>
{{ $item[0]->item_name }}<br>
商品説明<br>
{{ $item[0]->item_desc }}<br>
価格<br>
{{ $item[0]->item_price }}円<br>
在庫の有無<br>
@if ($item[0]->item_stock == 0)
	在庫なし
@else ($item[0]->item_stock >= 1)
	在庫あり
@endif
@endsection
