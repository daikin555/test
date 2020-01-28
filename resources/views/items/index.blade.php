<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>課題32 表示</title>
</head>
<body>
<h1>商品一覧</h1>
<table border='2'>
<tr>
<td>商品</td>
<td>値段</td>
<td>在庫</td>
</tr>
@foreach ($items as $item)
	<tr>
	<td>
	<a href="{{ route('item.name', ['id' => $item->id]) }}">{{ $item->name }}</a>
	</td>
	<td>{{ $item->price }}</td>
	<td>
	@if ($item->stock == 0)
		在庫なし
	@elseif ($item->stock >= 1)
		在庫あり
	@endif
	</td>
	</tr>
@endforeach
</body>
</html>
