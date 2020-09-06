<?php $__env->startSection('content'); ?>
<div class="container">
<div class="row">
<div class="col-md-8 col-md-offset-2">
<div class="panel panel-default">
<div class="panel-heading">商品一覧</div>

<div class="panel-body">
購入日：<?php echo e($date); ?>

<table border='2'>
<tr>
<td>商品名</td>
<td>金額</td>
<td>個数</td>
</tr>

<?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php $__currentLoopData = $carts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<tr>
	<td>
	<?php echo e($item->name); ?>

	</td>
	<td><?php echo e($item->price); ?></td>
	<td>
	<?php echo e($cart->stock); ?>

	</td>
	</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</table>
<a href="<?php echo e(route('user.purchase')); ?>">戻る</a>

</div>
</div>
</div>
</div>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>