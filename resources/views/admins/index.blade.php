@extends('layouts.app_admin')

@section('content')
<div class="container">
<div class="row">
<div class="col-md-8 col-md-offset-2">
<div class="panel panel-default">
<div class="panel-heading">会員一覧</div>

<div class="panel-body">
@if (session('status'))
	<div class="alert alert-success">
	{{ session('status') }}
	</div>
@endif
<table border='2'>
<tr>
<td>ID</td>
<td>会員名</td>
</tr>
@foreach ($menbers as $menber)
	<tr>
	<td>
	{{ $menber->id }}
	</td>
	<td>
	<a href="{{ route('menber.detail', ['id' => $menber->id]) }}">{{ $menber->name }}</a>
	</td>
	</tr>
@endforeach
</table>

<a href="{{ route('items.index') }}">商品一覧へ</a>
</div>
</div>
</div>
</div>
</div>
@endsection
