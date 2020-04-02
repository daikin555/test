<?php $__env->startSection('content'); ?>
<?php if($errors->any()): ?>
<div class="alert alert-danger">
<ul>
<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<li><?php echo e($error); ?></li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>
</div>
<?php endif; ?>
<div class="container">
<div class="row">
<div class="col-md-8 col-md-offset-2">
<div class="panel panel-default">
<div class="panel-heading">商品画像編集</div>
<div class="panel-body">

<a href="<?php echo e(route('items.index')); ?>">商品一覧へ</a>
<br>
<form action="<?php echo e(route('items.add_img', ['item_id' => $item_id])); ?>" method="POST" enctype="multipart/form-data">
<?php echo e(csrf_field()); ?>

<input type="file" class="form-control" name="image_file">
<br>
<button class="btn btn-success">登録</button>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app_admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>