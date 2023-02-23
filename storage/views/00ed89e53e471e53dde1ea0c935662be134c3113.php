
<?php $__env->startSection('content'); ?>

		<div class="container margin_60">
			<div class="main_title">
				<h1>Borrowed Materials</h1>
				
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
										<?php if($lists->status == 'For Approval'): ?>
											<p align='right'><span class='badge bg-secondary'> Pending </span></p>
										<?php elseif($lists->status == 'Borrowed'): ?>
											<p align='right'>Total days borrowed : <?php echo e($lists->total_days); ?> </span></p>
										<?php endif; ?>
									</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php else: ?>
					<div class="strip_list wow fadeIn">
						<div class="row">
							<div class="col-12">
								<p align='center'>
									No borrowed materials..
								</p>
							</div>
						</div>
					</div>
					<?php endif; ?>
					</div>
				<?php echo $__env->make('opac.side', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			</div>
				<!-- /col -->
		</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script>

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('opac.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /usr/local/www/apache24/elibrary/resources/views/opac/barrowed.blade.php ENDPATH**/ ?>