<?php $__env->startSection('content'); ?>
<div class="container">
<div class="row">
<div class="col-md-8 col-md-offset-2">
<div class="panel panel-default">
<div class="panel-heading">パスワード変更</div>

<div class="panel-body">
<!-- フラッシュメッセージ -->
<?php if(session('pass_message')): ?>
<div class="flash_message">
<font color="red">
<?php echo e(session('pass_message')); ?>

</font>
</div>
<?php endif; ?>
<form class="form-horizontal" method="POST" action="<?php echo e(route('update.password')); ?>">
<?php echo e(csrf_field()); ?>


<div class="form-group<?php echo e($errors->has('new_password') ? ' has-error' : ''); ?>">
<label for="password" class="col-md-4 control-label">新しいパスワード</label>

<div class="col-md-6">
<input id="password" type="password" class="form-control" name="new_password" required>

<?php if($errors->has('new_password')): ?>
<span class="help-block">
<strong><?php echo e($errors->first('new_password')); ?></strong>
</span>
<?php endif; ?>
</div>
</div>

<div class="form-group<?php echo e($errors->has('password_confirmation') ? ' has-error' : ''); ?>">
<label for="password-confirm" class="col-md-4 control-label">新しいパスワード（確認）</label>
<div class="col-md-6">
<input id="confirm" type="password" class="form-control" name="new_password_confirmation" required>

<?php if($errors->has('password_confirmation')): ?>
<span class="help-block">
<strong><?php echo e($errors->first('password_confirmation')); ?></strong>
</span>
<?php endif; ?>
</div>
</div>

<div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
<label for="old_password" class="col-md-4 control-label">現在のパスワード</label>

<div class="col-md-6">
<input id="old_password" type="password" class="form-control" name="password" required>

<?php if($errors->has('password')): ?>
<span class="help-block">
<strong><?php echo e($errors->first('password')); ?></strong>
</span>
<?php endif; ?>
</div>
</div>

<div class="form-group">
<div class="col-md-6 col-md-offset-4">
<button type="submit" class="btn btn-primary">
パスワード変更
</button>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>