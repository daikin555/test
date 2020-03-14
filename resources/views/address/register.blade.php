@extends('layouts.app')

@section('content')
<script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
<div class="container">
<div class="row">
<div class="col-md-8 col-md-offset-2">
<div class="panel panel-default">
<div class="panel-heading">登録住所変更</div>
<div class="panel-body">

@if (session('register_message'))
	<div class="flash_message">
	<font color="red">
	{{ session('register_message') }}
	</font>
	</div>
@endif

{{ Form::open(['route' => 'address.add']) }}
{{ csrf_field() }}
{{ Form::label('name', '宛名:') }}
{{ Form::text('name') }}
@if ($errors->has('name'))
	 <font color="red">
	{{ $errors->first('name') }}
	</font>
@endif
<br>
{{ Form::label('郵便番号', '郵便番号:') }}
{{ Form::text('postcode',null, array('onkeyup'=>"AjaxZip3.zip2addr(this,'','prefecture','city','block')")) }}
@if ($errors->has('postcode'))
	<font color="red">
	{{ $errors->first('postcode') }}
	</font>
@endif
<br>
{{ Form::label('都道府県', '都道府県:') }}
{{ Form::text('prefecture') }}
@if ($errors->has('prefecture'))
	<font color="red">
	{{ $errors->first('prefecture') }}
	</font>
@endif
<br>
{{ Form::label('住所（市区町村郡）', '住所（市区町村郡）:') }}
{{ Form::text('city') }}
@if ($errors->has('city'))
	<font color="red">
	{{ $errors->first('city') }}
	</font>
@endif
<br>
{{ Form::label('住所（町名番地）', '住所（町名番地）:') }}
{{ Form::text('block') }}
@if ($errors->has('block'))
	<font color="red">
	{{ $errors->first('block') }}
	</font>
@endif
<br>
{{ Form::label('phone_number', '電話番号:') }}
{{ Form::text('phone_number') }}
@if ($errors->has('phone_number'))
	<font color="red">
	{{ $errors->first('phone_number') }}
	</font>
@endif
<br>
{{ Form::submit('登録') }}

</div>
</div>
</div>
</div>
</div>
</div>
@endsection
