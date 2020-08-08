<?php $__env->startSection('content'); ?>
<div class="container">
<div class="row">
<div class="col-md-8 col-md-offset-2">
<div class="panel panel-default">
<div class="panel-heading">お届け先を選択</div>

<div class="panel-body">
<a href="<?php echo e(route('address.register')); ?>"><?php echo e(Form::button('新しく住所を登録する')); ?></a>

<?php if(session('index_message')): ?>
	<div class="flash_message">
	<font color="red">
	<?php echo e(session('index_message')); ?>

	</font>
	</div>
<?php endif; ?>
<?php echo e(Form::open(['route' => 'stripe'])); ?>

<?php echo e(csrf_field()); ?>

<table border='2'>
<?php $__currentLoopData = $address; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $add): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<tr>
	<td width="30" align="center">
	<?php echo e(Form::radio('delivery', $add->id)); ?>

	</td>
	<th>
	<?php echo e($add->md5); ?>

	</th>
	<th>
	<a href="<?php echo e(route('address.edit', ['id' => $add->id])); ?>"><?php echo e(Form::button('編集')); ?></a>
	</th>
	<th>
	<a href="<?php echo e(route('address.delete', ['id' => $add->id])); ?>"><?php echo e(Form::button('削除')); ?></a>
	</th>
	</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</table>
<?php echo e(Form::submit('購入画面へ')); ?>

<?php echo e(Form::close()); ?>

<p><a href="<?php echo e(route('item.index')); ?>">商品一覧へ戻る</a></p>
</div>
</div>
</div>
</div>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>