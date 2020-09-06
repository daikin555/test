<?php $__env->startSection('content'); ?>
<div class="container">
<div class="row">
<div class="col-md-8 col-md-offset-2">
<div class="panel panel-default">
<div class="panel-heading">注文履歴</div>

<div class="panel-body">
<!-- フラッシュメッセージ -->
<?php if(session('index_message')): ?>
	<div class="flash_message">
	<font color="red">
	<?php echo e(session('index_message')); ?>

	</font>
	</div>
<?php endif; ?>
<table border='2'>
<tr>
<td>注文日</td>
<td>合計金額</td>
<td>お届け先</td>
<td>商品情報</td>
<td>対応状況</td>
</tr>
<?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<tr>
	<td>
	<?php echo e($payment->created_at); ?>

	</td>
	<td><?php echo e($payment->amount); ?></td>
	<td><?php echo e($payment->address); ?></td>
	<td>
		<a href="<?php echo e(route('purchase.detail', ['id' => $payment->id, 'date' => $payment->created_at])); ?>">商品詳細へ</a>
	</td>
	<td>
	<?php if($payment->status == config('status.previous')): ?>
		対応中<?php echo e(Form::button('キャンセル可能', ['data-toggle' => 'modal', 'data-target' => '#modal-example'])); ?></a>
	<div class="modal" id="modal-example" tabindex="-1">
	<div class="modal-dialog">
	<div class="modal-content">
	<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal">
	<span aria-hidden="true">&times;</span>
	</button>
	<h4 class="modal-title" id="modal-label">
	確認
	</h4>
	</div>
	<div class="modal-body">
	<p>本当にキャンセルしますか？</p>
	</div>
	<div class="modal-footer">
	<a href="<?php echo e(route('cancel', ['id' => $payment->id, 'status' => $payment->status])); ?>"><button type="button" class="btn btn-primary">
	注文をキャンセルする
	</button></a>
	<button type="button" class="btn btn-default" data-dismiss="modal">
	戻る
	</button>
	</div>
	</div>
	</div>
	</div>
	<?php else: ?>
		発送済み　キャンセル不可
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