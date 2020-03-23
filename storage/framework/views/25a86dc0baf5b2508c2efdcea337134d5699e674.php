<?php $__env->startSection('content'); ?>
<div class="container">
<div class="row">
<div class="col-md-8 col-md-offset-2">
<div class="panel panel-default">
<div class="panel-heading">パスワード変更</div>
<div class="panel-body">


<!-- フラッシュメッセージ -->
<?php if(session('index_message')): ?>
	<div class="flash_message">
	<font color="red">
	<?php echo e(session('index_message')); ?>

	</font>
	</div>
<?php endif; ?>

<table>
	<tr>
	<td align="right">
	名前：
	</td>
	<th>
	
	</th>
	<th>
	<a href="<?php echo e(route('user.edit_name')); ?>"><?php echo e(Form::button('編集')); ?></a>
	</th>
	</tr>
	<tr>
	<td>
	メールアドレス：
	</td>
	<th>
	
	</th>
	<th>
	<a href="<?php echo e(route('user.edit_email')); ?>"><?php echo e(Form::button('編集')); ?></a>
	</th>
	</tr>
	<tr>
	<td align="right">
	パスワード：
	</td>
	<th>
	設定済
	</th>
	<th>
	<a href="<?php echo e(route('user.edit_password')); ?>"><?php echo e(Form::button('編集')); ?></a>
	</th>
	</tr>
</table>
<?php echo e(Form::close()); ?>

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