@extends('layouts.app_admin')

@section('content')
@if ($errors->any())
<div class="alert alert-danger">
<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif
<div class="container">
<div class="row">
<div class="col-md-8 col-md-offset-2">
<div class="panel panel-default">
<div class="panel-heading">商品画像編集</div>
<div class="panel-body">

<a href="{{ route('items.index') }}">商品一覧へ</a>
<br>
<form action="{{ route('items.add_img', ['item_id' => $item_id]) }}" method="POST" enctype="multipart/form-data">
{{ csrf_field() }}
<input type="file" class="form-control" name="image_file">
<br>
<button class="btn btn-success">登録</button>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
@endsection
