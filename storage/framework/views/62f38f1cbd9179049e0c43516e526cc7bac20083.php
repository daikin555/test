<?php $__env->startSection('content'); ?>
<div class="container">
<div class="row">
<div class="col-md-8 col-md-offset-2">
<div class="panel panel-default">
<div class="panel-heading">商品編集</div>
<div class="panel-body">

<a href="<?php echo e(route('items.index')); ?>">商品一覧へ</a>
<br>
商品画像<br>
<?php if($item->image == NULL): ?>
画像なし
<?php else: ?>
<img src="<?php echo e(asset('/storage/image/'.$item->image)); ?>"width="200" height="200">
<?php endif; ?>
<br>
<a href="<?php echo e(route('items.img', ['item_id' => $item->id])); ?>">商品画像編集はこちら</a>
<br>
<?php echo e(Form::open(['route' => 'items.edit'])); ?>

商品名:
<?php echo e(Form::text('name' , $item->name)); ?><br>
商品説明<br>
<?php echo e(Form::textarea('descrip' , $item->descrip)); ?><br>
<p>
在庫数：
<?php echo e(Form::text('stock', $item->stock)); ?>

</p>
<?php echo e(Form::submit('商品編集')); ?>

</div>
</div>
</div>
</div>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app_admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>