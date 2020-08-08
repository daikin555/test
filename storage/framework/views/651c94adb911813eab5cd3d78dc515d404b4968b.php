<?php $__env->startSection('content'); ?>
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">決済・確認画面</div>
					<div class="panel-body">

						<!-- フラッシュメッセージ -->
						<?php if(session('index_message')): ?>
						<div class="flash_message">
							<font color="red">
							<?php echo e(session('index_message')); ?>

							</font>
						</div>
						<?php endif; ?>

						商品の確認
						<table border='1'>
							<tr>
							<th>
							商品名
							</th>
							<th>
							個数
							</th>
							<th>
							金額
							</th>
							</tr>
							<tr>
							<?php $__currentLoopData = $carts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<td>
							<?php echo e($cart->item->name); ?>

							</td>
							<td>
							<?php echo e($cart->stock); ?>

							</td>
							<td>
							<?php echo e($cart->subtotal()); ?>

							</td>
							</tr>
							<tr>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							<th>
							合計
							</th>
							<td>
							<?php echo e($stocktotals); ?>

							</td>
							<td>
							<?php echo e($totals); ?>

							</td>
							</tr>
						</table>
						<p><a href="<?php echo e(route('cart.add')); ?>">商品編集へ戻る</a></p>

						お届け先の確認
						<table border='1'>
							<tr>
							<td>
							<?php echo e($delivery->md5); ?>

							</td>
							</tr>
						</table>

						<p><a href="<?php echo e(route('address.index')); ?>">お届け先を変更する</a></p>

						<form id="app" action="<?php echo e(route('charge')); ?>" method="POST">
							<?php echo e(csrf_field()); ?>

							<a class="btn btn-primary" href="<?php echo e(route('address.index')); ?>">戻る</a>
							<script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
								data-key="<?php echo e(env('STRIPE_PUBLIC_KEY')); ?>"
								data-amount="<?php echo e($totals); ?>"
								data-name="決済確認画面"
								data-label="決済をする"
								data-description="Online course about integrating Stripe"
								data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
								data-locale="auto"
								data-zip-code="false"
								data-currency="JPY"
								data-email="<?php echo e(Auth::user()->email); ?>">
							</script>
						</form>
						</body>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>