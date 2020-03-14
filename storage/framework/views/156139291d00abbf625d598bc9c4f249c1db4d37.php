<?php $__env->startSection('content'); ?>
<script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
<div class="container">
<div class="row">
<div class="col-md-8 col-md-offset-2">
<div class="panel panel-default">
<div class="panel-heading">お届け先修正</div>
<div class="panel-body">
<?php if(session('edit_message')): ?>
	<div class="flash_message">
	<font color="red">
	<?php echo e(session('edit_message')); ?>

	</font>
	</div>
<?php endif; ?>

<?php echo e(Form::open(['route' => 'address.update'])); ?>

<?php echo e(csrf_field()); ?>

<?php echo e(Form::label('name', '宛名:')); ?>

<?php echo e(Form::text('name')); ?>

<?php if($errors->has('name')): ?>
	<font color="red">
	<?php echo e($errors->first('name')); ?>

	</font>
<?php endif; ?>
元：<?php echo e($address->name); ?>

<br>
<?php echo e(Form::label('郵便番号', '郵便番号:')); ?>

<?php echo e(Form::text('postcode', null, array('onkeyup'=>"AjaxZip3.zip2addr(this,'','prefecture','city','block')"))); ?>

<?php if($errors->has('postcode')): ?>
	<font color="red">
	<?php echo e($errors->first('postcode')); ?>

	</font>
<?php endif; ?>
元：<?php echo e($address->postcode); ?>

<br>
<?php echo e(Form::label('prefecture', '都道府県:')); ?>

<?php echo e(Form::text('prefecture')); ?>

<?php if($errors->has('prefecture')): ?>
	<font color="red">
	<?php echo e($errors->first('prefecture')); ?>

	</font>
<?php endif; ?>
元：<?php echo e($address->prefecture); ?>

<br>
<?php echo e(Form::label('city', '住所（市区町村郡）:')); ?>

<?php echo e(Form::text('city')); ?>

<?php if($errors->has('city')): ?>
	<font color="red">
	<?php echo e($errors->first('city')); ?>

	</font>
<?php endif; ?>
元：<?php echo e($address->city); ?>

<br>
<?php echo e(Form::label('block', '住所（町名番地）:')); ?>

<?php echo e(Form::text('block')); ?>

<?php if($errors->has('block')): ?>
	<font color="red">
	<?php echo e($errors->first('block')); ?>

	</font>
<?php endif; ?>
元：<?php echo e($address->block); ?>

<br>
<?php echo e(Form::label('phone_number', '電話番号:')); ?>

<?php echo e(Form::text('phone_number')); ?>

<?php if($errors->has('phone_number')): ?>
	<font color="red">
	<?php echo e($errors->first('phone_number')); ?>

	</font>
<?php endif; ?>
元：<?php echo e($address->phone_number); ?>

<br>
<?php echo e(Form::hidden('id', $address->id)); ?>

<?php echo e(Form::submit('編集')); ?>

<?php echo e(Form::close()); ?>

<br>
<a href="<?php echo e(route('address.index')); ?>">戻る</a>
</div>
</div>
</div>
</div>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>