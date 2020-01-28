@extends('layouts.app_admin')

@section('content')
<div class="container">
<div class="row">
<div class="col-md-8 col-md-offset-2">
<div class="panel panel-default">
<div class="panel-heading">商品編集</div>
<div class="panel-body">

<a href="{{ route('items.index') }}">商品一覧へ</a>
<br>
{{ Form::open(['route' => 'items.edit']) }}
商品名:
{{ Form::text('name' , $item->name) }}<br>
商品説明<br>
{{ Form::textarea('descrip' , $item->descrip) }}<br>
<p>
在庫数：
{{ Form::text('stock', $item->stock) }}
</p>
{{ Form::submit('商品編集') }}
</div>
</div>
</div>
</div>
</div>
</div>
@endsection
