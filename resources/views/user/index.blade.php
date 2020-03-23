@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
<div class="col-md-8 col-md-offset-2">
<div class="panel panel-default">
<div class="panel-heading">アカウントページ</div>
<div class="panel-body">


<!-- フラッシュメッセージ -->
@if (session('index_message'))
	<div class="flash_message">
	<font color="red">
	{{ session('index_message') }}
	</font>
	</div>
@endif

<table>
	<tr>
	<td align="right">
	名前：
	</td>
	<th>
	{{ $auth->name }}
	</th>
	<th>
	<a href="{{ route('user.edit_name') }}">{{ Form::button('編集') }}</a>
	</th>
	</tr>
	<tr>
	<td>
	メールアドレス：
	</td>
	<th>
	{{ $auth->email }}
	</th>
	<th>
	<a href="{{ route('user.edit_email') }}">{{ Form::button('編集') }}</a>
	</th>
	</tr>
	<tr>
	<td align="right">
	パスワード：
	</td>
	<th>
	設定済
	</th>
	<th>
	<a href="{{ route('user.edit_password') }}">{{ Form::button('編集') }}</a>
	</th>
	</tr>
</table>
{{ Form::close() }}
<p><a href="{{ route('item.index') }}">商品一覧へ戻る</a></p>
</body>

</div>
</div>
</div>
</div>
</div>
</div>
@endsection
