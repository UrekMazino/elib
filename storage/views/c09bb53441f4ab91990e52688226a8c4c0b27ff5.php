
<?php $__env->startSection('content'); ?>

		<div class="container margin_60">
			<div class="main_title">
				<h1>Reviews</h1>
			</div>
			<div class="row">
				<div class="col-9">
				<?php if($flag): ?>
				<?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lists): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<div class="strip_list wow fadeIn">
									<figure>
											<?php echo getFrontpage($lists->holdings_id); ?>

									</figure>
									<h3><?php echo formatTitle($lists->title_statement); ?></h3>
									<span class="text-muted"><?php echo e($lists->joint_authors); ?></span><br>

									<?php echo pubYear($lists->pub_year); ?>

									
									<?php if($lists->edition != '' && $lists->edition != null): ?>
										<b>Edition : </b> <?php echo e(formatText($lists->edition)); ?><br/>
									<?php endif; ?>
									
									<div class="rating">
										<i data-star="<?php echo e($ave = starRatingAve($lists->id)); ?>"></i>
									</div>
									<p align='right'><button class="btn_1" onclick="toReview(<?php echo e($lists->id); ?>,'<?php echo e($lists->holdings_id); ?>')">Review</button></p>
								</div>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php else: ?>
				<div class="strip_list wow fadeIn">
					<div class="row">
						<div class="col-12">
							<p align='center'>
								No materials for review..
							</p>
						</div>
					</div>
				</div>
				<?php endif; ?>
				</div>
				<?php echo $__env->make('opac.side', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			</div>
			<?php echo e($list->links('vendor.pagination.default')); ?>

				<!-- /col -->
		</div>
<form method="post" action="<?php echo e(url('/review')); ?>" id="frm_review">
	<?php echo csrf_field(); ?>
	<input type="hidden" class="form-control" name="holdings_id" id="holdings_id" value="">
	<input type="hidden" class="form-control" name="download_id" id="download_id" value="">
</form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script type="text/javascript">

function  toReview(id,holdings_id) {
	$("#holdings_id").val(holdings_id);
	$("#download_id").val(id);
	$("#frm_review").submit();
}
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('opac.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /usr/local/www/apache24/elibrary/resources/views/opac/to-review.blade.php ENDPATH**/ ?>