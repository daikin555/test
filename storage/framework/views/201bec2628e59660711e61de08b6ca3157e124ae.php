<?php $__env->startSection('content'); ?>
<div class="container">
<div class="row">
<div class="col-md-8 col-md-offset-2">
<div class="panel panel-default">
<div class="panel-heading">商品一覧</div>

<div class="panel-body">
<table border='2'>
<tr>
<td>商品</td>
<td>値段</td>
<td>在庫</td>
</tr>
<?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<tr>
	<td>
	<a href="<?php echo e(route('item.name', ['id' => $item->id])); ?>"><?php echo e($item->name); ?></a>
	</td>
	<td><?php echo e($item->price); ?></td>
	<td>
	<?php if($item->stock == 0): ?>
		在庫なし
	<?php elseif($item->stock >= 1): ?>
		在庫あり
	<?php endif; ?>
	</td>
	</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
</div>
</div>
</div>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>