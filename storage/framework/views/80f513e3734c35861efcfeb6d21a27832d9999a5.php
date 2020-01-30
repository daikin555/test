<?php $__env->startSection('content'); ?>
<div class="container">
<div class="row">
<div class="col-md-8 col-md-offset-2">
<div class="panel panel-default">
<div class="panel-heading">商品詳細</div>
<div class="panel-body">
<!-- フラッシュメッセージ -->
<?php if(session('edit_message')): ?>
	<div class="flash_message">
	<?php echo e(session('edit_message')); ?>

	</div>
<?php endif; ?>
<a href="<?php echo e(route('items.index')); ?>">商品一覧へ</a>
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
	在庫あり
<?php endif; ?>
<br>
<a href="<?php echo e(route('items.edit')); ?>">商品編集</a>
</div>
</div>
</div>
</div>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app_admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>