@extends('layouts.app_admin')

@section('content')
<div class="container">
<div class="row">
<div class="col-md-8 col-md-offset-2">
<div class="panel panel-default">
<div class="panel-heading">管理者ボード</div>

<div class="panel-body">
@if (session('status'))
	<div class="alert alert-success">
	{{ session('status') }}
	</div>
@endif
<a href="{{ route('items.index') }}">商品管理はこちら</a>
</div>
</div>
</div>
</div>
</div>
@endsection
