@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
<div class="col-md-8 col-md-offset-2">
<div class="panel panel-default">
<div class="panel-heading">メールアドレス変更</div>

<div class="panel-body">
<form class="form-horizontal" method="POST" action="{{ route('send.email') }}">
{{ csrf_field() }}

<div class="form-group{{ $errors->has('mail') ? ' has-error' : '' }}">
<label for="name" class="col-md-4 control-label">新しいメールアドレス</label>

<div class="col-md-6">
<input id="mail" type="mail" class="form-control" name="email" autofocus>

@if ($errors->has('name'))
<span class="help-block">
<strong>{{ $errors->first('mail') }}</strong>
</span>
@endif
</div>
</div>

<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
<label for="password" class="col-md-4 control-label">パスワード</label>

<div class="col-md-6">
<input id="password" type="password" class="form-control" name="password" >

@if ($errors->has('password'))
<span class="help-block">
<strong>{{ $errors->first('password') }}</strong>
</span>
@endif
</div>
</div>

<div class="form-group">
<div class="col-md-6 col-md-offset-4">
<button type="submit" class="btn btn-primary">
Reset Password
</button>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
@endsection
