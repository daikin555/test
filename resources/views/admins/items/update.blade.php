@extends('layouts.app_admin')

@section('content')
<div class="container">
<div class="row">
<div class="col-md-8 col-md-offset-2">
<div class="panel panel-default">
<div class="panel-heading">商品追加</div>
<div class="panel-body">
@if (session('status'))
	<div class="alert alert-success">
	{{ session('status') }}
	</div>
@endif

<a href="{{ route('items.index') }}">商品一覧へ</a>
<br>
{{ Form::open(['route' => 'items.add']) }}
<br>
商品名：
{{ Form::text('name') }}
<br>
商品説明
<br>
{{ Form::textarea('descrip') }}
<br>
<p>在庫数：
{{ Form::text('stock') }}
</p>
<p>
値段：
{{ Form::text('price') }}
</p>
{{ Form::submit('商品追加') }}
</div>
</div>
</div>
</div>
</div>
</div>

@endsection
