<?php $__env->startSection('content'); ?>
<div class="container">
<div class="row">
<div class="col-md-8 col-md-offset-2">
<div class="panel panel-default">
<div class="panel-heading">商品詳細</div>

<div class="panel-body">
<!-- フラッシュメッセージ -->
<?php if(session('add_message')): ?>
	<div class="flash_message">
	<font color="red">
	<?php echo e(session('add_message')); ?>

	</font>
	</div>
<?php endif; ?>
商品画像<br>
<?php if($item->image == NULL): ?>
画像なし
<?php else: ?>
<img src="<?php echo e(asset('/storage/image/'.$item->image)); ?>" width="200" height="200">
<?php endif; ?>
<br>
商品名<br>
<?php echo e($item->name); ?><br>
商品説明<br>
<?php echo e($item->descrip); ?><br>
価格<br>
<?php echo e($item->price); ?>円<br>
在庫の有無<br>
<?php if($item->stock == 0): ?>
	在庫なし
<?php else: ?>
	在庫あり<br>
	<?php if(Auth::user()): ?>
	<a href="<?php echo e(route('cart.add')); ?>"><?php echo e(Form::button('カートに入れる')); ?></a>
	<?php else: ?>
	<a href="<?php echo e(route('cart.add')); ?>"><?php echo e(Form::button('ログインする')); ?></a>
	<?php endif; ?>
<?php endif; ?>
<br>
<a href="<?php echo e(route('item.index')); ?>">商品一覧へ</a>
</div>
</div>
</div>
</div>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>