

<?php $__env->startSection('css'); ?>
    <!-- SPECIFIC CSS -->
    <link href="<?php echo e(asset('opac/css/date_picker.css')); ?>" rel="stylesheet">
 <?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
   <div id="results" style="background-color: #00a496;">
       <div class="container">
           <div class="row">
               <div class="col-md-6">
                   <!-- <h4><strong>Showing 10</strong> of <?php echo e($result->total()); ?> results</h4> -->
               </div>
               <div class="col-md-6">
               	<form method="get" action="<?php echo e(url('/results')); ?>" id="frm">
					<?php echo csrf_field(); ?>
                    <div class="search_bar_list">
                    <input type="text" class="form-control" name="query" placeholder="Search a Material...">
                    <input type="hidden" name="series_statement_id" value="0">
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
					<h6>Type</h6>
					<div class="form-check form-check-inline">
							<input class="form-check-input" type="checkbox" value="all-material" id="checkAll" name="seachtype[]" checked>
	  						<label class="form-check-label" for="checkAll" style="padding: 2px!important;background-color: transparent;">
	    								All
	  						</label>
  						</div>
  						<div class="form-check form-check-inline">
							<input class="form-check-input" type="checkbox" value="1" name="seachtype[]" id="flexCheckChecked">
	  						<label class="form-check-label lbl-check" for="flexCheckChecked" style="padding: 2px!important;background-color: transparent;">
	    								Books
	  						</label>
  						</div>
  						<div class="form-check form-check-inline">
							<input class="form-check-input" type="checkbox" value="3" name="seachtype[]" id="flexCheckChecked">
	  						<label class="form-check-label lbl-check" for="flexCheckChecked" style="padding: 2px!important;background-color: transparent;">
	    								Thesis
	  						</label>
  						</div>
  						<div class="form-check form-check-inline">
							<input class="form-check-input" type="checkbox" value="2" name="seachtype[]" id="flexCheckChecked">
	  						<label class="form-check-label lbl-check" for="flexCheckChecked" style="padding: 2px!important;background-color: transparent;">
	    								Magazines and Journals
	  						</label>
  						</div>
  						
  						<div class="form-check form-check-inline">
							<input class="form-check-input" type="checkbox" value="9" name="seachtype[]" id="flexCheckChecked">
	  						<label class="form-check-label lbl-check" for="flexCheckChecked" style="padding: 2px!important;background-color: transparent;">
	    								Articles
	  						</label>
  						</div>
  						</form>
				</li>
				<!-- <li>
					<h6>Layout</h6>
					<div class="layout_view">
						<a href="#0" class="active"><i class="icon-th"></i></a>
						<a href="list.html"><i class="icon-th-list"></i></a>
						<a href="list-map.html"><i class="icon-map-1"></i></a>
					</div>
				</li>
				<li>
					<h6>Sort by</h6>
					<select name="orderby" class="selectbox">
					<option value="Closest">Closest</option>
					<option value="Best rated">Best rated</option>
					<option value="Men">Men</option>
					<option value="Women">Women</option>
					</select>
				</li> -->
			</ul>
		</div>
		<!-- /container -->
	</div>
	<!-- /filters -->
	   
	<div class="container margin_60_35">
		<div class="row">
			<div class="col-lg-12">
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
								<a href="detail-page.html"><img src="<?php echo e(asset('thumb/'.getRandomImage())); ?>" class="img-fluid" alt="">
								</a>
							</figure>
							<div class="wrapper">
								<small><?php echo e($results->material); ?></small>
								<h5><?php echo e(maxTitle(formatTitle1($results->title_statement))); ?></h5>
								<?php echo getRandomRating(); ?>

							</div>
							<ul>
								<li><a href="#0" onclick="onHtmlClick('Doctors', 0)">
								<li><a href="https://www.google.com/maps/dir//Assistance+%E2%80%93+H%C3%B4pitaux+De+Paris,+3+Avenue+Victoria,+75004+Paris,+Francia/@48.8606548,2.3348734,14z/data=!4m15!1m6!3m5!1s0x0:0xa6a9af76b1e2d899!2sAssistance+%E2%80%93+H%C3%B4pitaux+De+Paris!8m2!3d48.8568376!4d2.3504305!4m7!1m0!1m5!1m1!1s0x47e67031f8c20147:0xa6a9af76b1e2d899!2m2!1d2.3504327!2d48.8568361" target="_blank"><i class="icon_pin_alt"></i>Directions</a></li>
								<li><a href="#" onclick="submitFrm('<?php echo e($results->id); ?>')">Full description</a></li>
							</ul>
						</div>
					</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<!-- /box_list -->

					
				</div>
				<!-- /row -->


				<?php echo e($result->appends(['seachtype' => $_GET['seachtype'],'series_statement_id' => $_GET['series_statement_id']])->links('vendor.pagination.default')); ?>


				<!-- /pagination -->
			</div>
			<!-- /col -->
			
			<!-- <aside class="col-lg-4" id="sidebar">
				<div id="map_listing" class="normal_list">
				</div>
			</aside> -->
			<!-- /aside -->
			
		</div>
		<!-- /row -->
	</div>
<form method="post" action="<?php echo e(url('/full-description')); ?>" id="frm2" target="_blank">
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
		$("#holding_id").val(id)
		$("#frm2").submit();
	}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('opac.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\slims\resources\views/opac/search-result.blade.php ENDPATH**/ ?>