<?php $__env->startSection('content'); ?>
<div class="container">
<div class="row">
<div class="col-md-8 col-md-offset-2">
<div class="panel panel-default">
<div class="panel-heading">カート内容</div>
<div class="panel-body">

<!-- フラッシュメッセージ -->
<?php if(session('del_message')): ?>
	<div class="flash_message">
	<?php echo e(session('del_message')); ?>

	</div>
<?php endif; ?>
<?php if(0 < $carts->count()): ?>
	<table border='2'>
	<tr>
	<th>商品名</th>
	<th>購入数</th>
	<th>価格</th>
	<th>削除</th>
	</tr>
	<?php $__currentLoopData = $carts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<tr>
		<td align="right"><?php echo e($cart->item->name); ?></td>
		<td align="right"><?php echo e($cart->stock); ?></td>
		<td align="right"><?php echo e($cart->subtotal()); ?></td>
		<td>
		<?php echo e(Form::open(['route' => 'cart.delete'])); ?>

		<?php echo e(csrf_field()); ?>

		<?php echo e(Form::hidden('cart_id', $cart->id)); ?>

		<?php echo e(Form::submit('削除')); ?>

		<?php echo e(Form::close()); ?>

		</td></tr>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	<td>合計</td>
	<td><?php echo e($subtotals); ?></td>
	<td>税込: <?php echo e($totals); ?></td>
	<td></td>
	</td>
	</table>
<?php else: ?>
	<h1>カートに商品はありません</h1>
<?php endif; ?>
<br>
<p><a href="<?php echo e(route('item.index')); ?>">商品一覧へ戻る</a></p>
</body>

</div>
</div>
</div>
</div>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>