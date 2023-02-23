



<?php $__env->startSection('content'); ?>
		<div class="hero_home version_1">
			<div class="content">
				<h3><img src="<?php echo e(asset('opac/img/elibrary-06.png')); ?>" alt="" width="400"class="img-fluid"></h3>
				<p>
					<!-- Ridiculus sociosqu cursus neque cursus curae ante scelerisque vehicula. -->
				</p>
				<form method="get" action="<?php echo e(url('/results')); ?>" id="frm">
					<?php echo csrf_field(); ?>
					<input type="hidden" name="page" value="1">
					<input type="hidden" name="series_statement_id" value="0">
					<input type="hidden" name="layout" value="grid">
					<div id="custom-search-input">
						<div class="input-group">
							<input type="text" class="search-query" name="query" placeholder="Search a Material...">
							<input type="submit" class="btn_search" value="Search">
						</div>
						<br/>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="checkbox" value="all-material" id="checkAll" name="seachtype[]" checked>
	  						<label class="form-check-label" for="checkAll" style="padding: 2px!important;background-color: transparent;">
	    								All
	  						</label>
  						</div>

  						<?php $__currentLoopData = getMaterials(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $materials): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  						<div class="form-check form-check-inline">
							<input class="form-check-input" type="checkbox" value="<?php echo e($materials->id); ?>" name="seachtype[]" id="materials-<?php echo e($materials->id); ?>">
	  						<label class="form-check-label lbl-check" id="materials-<?php echo e($materials->id); ?>" style="padding: 2px!important;background-color: transparent;" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e($materials->tooltip); ?>">
	    								<?php echo e($materials->name); ?>

	  						</label>
  						</div>
  						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  						

					</div>
				</form>
			</div>
		</div>

		

		<div class="container margin_120_95">
			<div class="main_title">
				<h2>Most Downloaded Material</h2>
				
			</div>
			<div class="row add_bottom_30">
				<div id="most-downloaded" class="owl-carousel owl-theme">
					<?php $__currentLoopData = getRandomFullImage(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $values): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="item">
							<a href="<?php echo e(url('/full-description/'.$values->holdings_id)); ?>">
								<div class="views"><i class="icon-download-5"></i><?php echo e(randomNum()); ?></div>
								<div class="title">
								</div><?php echo getFrontpage($values->holdings_id); ?>

							</a>
						</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</div>
			</div>
		</div>
		<!-- /container -->

		<div class="bg_color_2">
			<div class="container margin_120_95">
				<div class="main_title">
					<h2 style="color:#FFF">Most Viewed</h2>
				</div>
				<div id="editors-choice" class="owl-carousel owl-theme">
					<?php $__currentLoopData = getRandomFullImage(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $values): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="item">
							<a href="<?php echo e(url('/full-description/'.$values->holdings_id)); ?>">
								<!-- <div class="views"><i class="icon-eye-7"></i><?php echo e(randomNum()); ?></div> -->
								<div class="title">
								</div><?php echo getFrontpage($values->holdings_id); ?>

							</a>
						</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</div>
			</div>
			<!-- /container -->
		</div>
		<!-- /white_bg -->
		<div class="container">
				<div class="row">
					<div class="col-lg-6 col-sm-12">
						<div class="container margin_120_95">
							<div class="main_title">
								<h2>Newest Material</h2>
							</div>
							<div class="row add_bottom_30">

								<div class="widget">
									<ul class="comments-list">
									<?php $__currentLoopData = getLatestMaterial(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $results): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<li>
										<div class="alignleft">
											<?php echo getFrontpage($results->holdings_id); ?>

										</div>
										<small>Year : <?php echo e($results->pub_year); ?></small>
										<h3><a href="#" title="" onclick="sendFrm('<?php echo e($results->holdings_id); ?>')"><?php echo e($results->title_statement); ?></a><br><small><?php echo e($results->joint_authors); ?></small></h3>
									</li>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-sm-12">
						<div class="container margin_120_95">
							<div class="main_title">
								<h2>Latest News</h2>
							</div>
							<div class="row add_bottom_30">
								<div class="widget">
									<ul class="comments-list">
									<?php $__currentLoopData = getLatestNews(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<li>
										<div class="alignleft">
											<?php if($news->news_cover): ?>
												<a href="#0"><img src="<?php echo e(url('/'.$news->news_cover)); ?>" alt=""></a>
											<?php else: ?>
												<a href="#0"><img src="http://via.placeholder.com/160x160.jpg" alt=""></a>
											<?php endif; ?>
										</div>
										<small><?php echo e(date('Y-m-d',strtotime($news->created_at))); ?></small>
										<h3><a href="#" title=""><?php echo e($news->news_title); ?></a></h3>
									</li>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
		</div>
		


		
		<!-- /app_section -->
		<!-- /Hero -->
<form method="post" action="<?php echo e(url('/full-description')); ?>" id="frm1">
	<?php echo csrf_field(); ?>
	<input type="hidden" name="holding_id" id="holding_id">
</form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script type="text/javascript">
	
	$("#checkAll").click(function () {
        $('.form-check-input').not(this).prop('checked', false);
      });

	$(".form-check-input").click(function () {
        $('#checkAll').not(this).prop('checked', false);
      });

	function sendFrm(val)
	{
		$("#holding_id").val(val);
		$("#frm1").submit();
	}
	
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('opac.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /usr/local/www/apache24/elibrary/resources/views/opac/index.blade.php ENDPATH**/ ?>