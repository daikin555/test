@extends('layouts.app')
@section('content')
<div class="container">
<div class="row">
<div class="col-md-8 col-md-offset-2">
<div class="panel panel-default">
<div class="panel-heading">お届け先を選択</div>

<div class="panel-body">
<a href="{{ route('address.register') }}">{{ Form::button('新しく住所を登録する') }}</a>

@if (session('index_message'))
	<div class="flash_message">
	<font color="red">
	{{ session('index_message') }}
	</font>
	</div>
@endif
<table border='2'>
@foreach ($address as $add)
	<tr>
	<td width="30" align="center">
	{{Form::radio('single')}}
	</td>
	<th>
	{{ $add->md5 }}
	</th>
	<th>
	<a href="{{ route('address.edit', ['id' => $add->id]) }}">{{ Form::button('編集') }}</a>
	</th>
	<th>
	<a href="{{ route('address.delete', ['id' => $add->id]) }}">{{ Form::button('削除') }}</a>
	</th>
	</tr>
@endforeach
</table>
<p><a href="{{ route('item.index') }}">商品一覧へ戻る</a></p>
</div>
</div>
</div>
</div>
</div>
</div>
@endsection
