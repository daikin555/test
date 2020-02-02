<?php $__env->startSection('content'); ?>
<div class="container">
<div class="row">
<div class="col-md-8 col-md-offset-2">
<div class="panel panel-default">
<div class="panel-heading">商品追加</div>
<div class="panel-body">
<?php if(session('status')): ?>
	<div class="alert alert-success">
	<?php echo e(session('status')); ?>

	</div>
<?php endif; ?>

<a href="<?php echo e(route('items.index')); ?>">商品一覧へ</a>
<br>
<?php echo e(Form::open(['route' => 'items.add'])); ?>

<br>
商品名：
<?php echo e(Form::text('name')); ?>

<br>
商品説明
<br>
<?php echo e(Form::textarea('descrip')); ?>

<br>
<p>在庫数：
<?php echo e(Form::text('stock')); ?>

</p>
<p>
値段：
<?php echo e(Form::text('price')); ?>

</p>
<?php echo e(Form::submit('商品追加')); ?>

</div>
</div>
</div>
</div>
</div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app_admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>