

<?php $__env->startSection('css'); ?>
    <!-- SPECIFIC CSS -->
    <link href="<?php echo e(asset('opac/css/date_picker.css')); ?>" rel="stylesheet">
 <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
   <div id="results" style="background-color: #00a496;">
       <div class="container">
           <div class="row">
               <div class="col-md-6">
                   
               </div>
               <div class="col-md-6">
               	<form method="get" action="<?php echo e(url('/results')); ?>" id="frm">
					<?php echo csrf_field(); ?>
                    <div class="search_bar_list">
	                    <input type="text" class="form-control" name="query" placeholder="Search a Material...">
						<?php if(isset($_GET['query'])): ?>
	                    <input type="hidden" name="query" value="<?php echo e($_GET['query']); ?>">
						<?php endif; ?>
	                    <input type="hidden" name="series_statement_id" value="<?php echo e($_GET['series_statement_id']); ?>">
	                    <input type="hidden" name="page" value="<?php echo e($_GET['page']); ?>">
	                    <input type="hidden" name="layout" id="layout" value="<?php echo e($_GET['layout']); ?>">
	                    <input type="submit" value="Search">
                	</div>
               </div>
           </div>
           <!-- /row -->
       </div>
       <!-- /container -->
   </div>
   <!-- /results -->

   <div class="filters_listing">
		<div class="container">
			<ul class="clearfix">
				<li>
					
  						</form>
				</li>
				<li>
						<h6>Layout</h6>
						<div class="layout_view">
							<a href="#0" class="active"><i class="icon-th"></i></a>
							<a href="#0" tooltip="List View"  data-bs-toggle="tooltip" data-bs-placement="top" title="List View"><i class="icon-th-list" onclick="changeLayout('list')"></i></a>
						</div>
					</li>
			</ul>
		</div>
		<!-- /container -->
	</div>
	<!-- /filters -->
	   
	<div class="container margin_60_35">
		<div class="row">
			<div class="col-lg-9">
				<?php if(isset($_GET['query']) && $_GET['query'] != ''): ?>
				<h3 class="alert alert-info">Results for "<?php echo e($_GET['query']); ?>"</h3>
				<?php else: ?>
					<?php if($_GET['series_statement_id'] != 0): ?>
						<h3 class="alert alert-info">Results for series : "<?php echo e(getSeriesDesc($_GET['series_statement_id'])); ?>"</h3>
					<?php endif; ?>
				<?php endif; ?>
				<div class="row">
					<?php $__currentLoopData = $result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $results): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<div class="col-md-4">
						<div class="box_list wow fadeIn">
							<figure>
								
								<?php echo getFrontpage($results->holdings_id); ?>

								</a>
							</figure>
							<div class="wrapper">
								<small><?php echo e($results->material); ?></small>
								<h5><?php echo e(maxTitle($results->title_statement)); ?></h5>
								<span class="text-muted"><?php echo e($results->joint_authors); ?></span><br>

								<?php echo pubYear($results->pub_year); ?>

								
								<?php if($results->edition != '' && $results->edition != null): ?>
									<b>Edition : </b> <?php echo e(formatText($results->edition)); ?><br/>
								<?php endif; ?>
								
								<div class="rating">
									<i data-star="<?php echo e($ave = starRatingAve($results->holdings_id)); ?>"></i>
								</div>
							</div>
							<ul>
								<li><a href="#">
								<li><a href="#" target="_blank"><i class="icon_pin_alt"></i></a></li>
								<li><a href="#" onclick="submitFrm('<?php echo e($results->holdings_id); ?>')">Full description</a></li>
							</ul>
						</div>
					</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<!-- /box_list -->

					
				</div>
				<!-- /row -->


				<?php echo e($result->appends(['series_statement_id' => $_GET['series_statement_id'],'layout' => $_GET['layout']])->links('vendor.pagination.default')); ?>


				<!-- /pagination -->
			</div>

			<aside class="col-xl-3 col-lg-3" id="sidebar">
				<div class="box_general_3 booking">
						<div class="title" style="background-color: #00a496;">
						<h3>Filter Result</h3>
						</div>
						<ul class="treatments clearfix">
							<?php $__currentLoopData = getMaterials(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $materials): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<li>
									<div class="checkbox">
										<input type="checkbox" class="css-checkbox" id="mat_<?php echo e($materials->id); ?>" name="visit_site" value="<?php echo e($materials->id); ?>">
										<label for="mat_<?php echo e($materials->id); ?>" class="css-label"><?php echo e($materials->name); ?></label>
									</div>
								</li>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</ul>
						
				</div>
			</aside>
			<!-- /col -->
		</div>
		<!-- /row -->
	</div>
<form method="POST" action="<?php echo e(url('/full-description')); ?>" id="frm2" target="_blank">
	<?php echo csrf_field(); ?>
	<input type="hidden" name="holding_id" id="holding_id">
</form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
	<!-- SPECIFIC SCRIPTS -->
	<script src="<?php echo e(asset('opac/js/markerclusterer.js')); ?>"></script>
    <script src="<?php echo e(asset('opac/js/map_listing.js')); ?>"></script>
    <script src="<?php echo e(asset('opac/js/infobox.js')); ?>"></script>
    <script type="text/javascript">
	
	$("#checkAll").click(function () {
        $('.form-check-input').not(this).prop('checked', false);
      });

	$(".form-check-input").click(function () {
        $('#checkAll').not(this).prop('checked', false);
      });

	function submitFrm(id)
	{
		$("#holding_id").val(id);
		$("#frm2").submit();
	}

	function changeLayout(layout)
	{
		$("#layout").val(layout);
		$("#frm").submit();
	}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('opac.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /usr/local/www/apache24/elibrary/resources/views/opac/search-result-grid.blade.php ENDPATH**/ ?>