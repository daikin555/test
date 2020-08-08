<?php $__env->startSection('content'); ?>
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">メールアドレス変更</div>

				<div class="panel-body">
					<form class="form-horizontal" method="POST" action="<?php echo e(route('send.email')); ?>">
					<?php echo e(csrf_field()); ?>


					<div class="form-group<?php echo e($errors->has('mail') ? ' has-error' : ''); ?>">
						<label for="mail" class="col-md-4 control-label">新しいメールアドレス</label>

						<div class="col-md-6">
							<input id="mail" type="mail" class="form-control" name="email" autofocus>

							<?php if($errors->has('email')): ?>
							<span class="help-block">
							<strong><?php echo e($errors->first('email')); ?></strong>
							</span>
							<?php endif; ?>
						</div>
					</div>

					<div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
						<label for="password" class="col-md-4 control-label">パスワード</label>

						<div class="col-md-6">
							<input id="password" type="password" class="form-control" name="password" >

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
							メールアドレス変更
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