@extends('layouts.app_admin')

@section('content')
<div class="container">
<div class="row">
<div class="col-md-8 col-md-offset-2">
<div class="panel panel-default">
<div class="panel-heading">会員情報</div>

<div class="panel-body">
@if (session('status'))
	<div class="alert alert-success">
	{{ session('status') }}
	</div>
@endif
名前
<p>{{ $details->name }}</p>
メールアドレス
<p>{{ $details->email }}</p>
お届け先住所
<p>
@foreach ($address as $add)
	・{{ $add->md5 }}
@endforeach
</p>

<a href="{{ route('items.index') }}">商品一覧へ</a>
</div>
</div>
</div>
</div>
</div>
@endsection
