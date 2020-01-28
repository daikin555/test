<!DOCTYPE HTML>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>課題32 詳細</title>
</head>
<body>
商品名<br>
{{ $item[0]->name }}<br>
商品説明<br>
{{ $item[0]->descrip }}<br>
価格<br>
{{ $item[0]->price }}円<br>
在庫の有無<br>
@if ($item[0]->stock == 0)
	在庫なし
@else ($item[0]->stock >= 1)
	在庫あり
@endif
</body>
</html>
