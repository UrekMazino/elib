
<?php $__env->startSection('css'); ?>
<style>
	.container-msg-reply {
	border: 2px solid #dedede;
	background-color: #f1f1f1;
	border-radius: 5px;
	padding: 20px;
	margin: 10px 0;
	}

	.darker {
	border-color: rgb(0, 107, 164);
	background-color: rgb(1, 152, 212);
	color: #FFF;
	}

	.time-right {
	float: right;
	color: #FFF;
	}

	/* Style time text */
	.time-left {
	float: left;
	color: #999;
	}
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

		<div class="container margin_60">
			<div class="main_title">
				<h1>Inquiries</h1>
				
			</div>
			<div class="row">
				<div class="col-9">
				<?php if($flag): ?>
				<?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lists): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<div class="strip_list wow fadeIn">
									<figure>
											<?php echo getFrontpage($lists->holdings_id); ?>

									</figure>
									<h3><?php echo $lists->message; ?></h3>
									<h6><?php echo getTitle($lists->holdings_id); ?></h6>
									<div class="row">
										<div class="col-6">
											<p align='left'>
												<i class="icon_comment_alt"></i> <?php echo e($lists->total_msg); ?>&nbsp&nbsp&nbsp
												<?php echo getReplies($lists->new_reply); ?>

											</p>
										</div>
										<div class="col-6">
											<p align='right'><button class="btn_1" onclick="showThread(<?php echo e($lists->id); ?>,<?php echo e(Auth::user()->id); ?>)">Show</button></p>
										</div>
									</div>
								</div>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php else: ?>
				<div class="strip_list wow fadeIn">
					<div class="row">
						<div class="col-12">
							<p align='center'>
								No inquiries..
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

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script type="text/javascript">


function showThread(id,userid)
{
	$("#holdings_id_inquiry_reply").val(id);
	$.getJSON( "<?php echo e(url('inquiry/json/')); ?>/"+id, function( datajson ) {

	}).done(function(datajson){
		$("#inquiry_message").text('');
		jQuery.each(datajson,function(i,obj){
			
			if(userid == obj.replied_by){
					$("#inquiry_message").append('<div class="container-msg-reply darker"><p>'+obj.replied_msg+'</p><span class="time-right"><small>'+obj.thread_date+'</small></span></div>');
				}
				else{
					$("#inquiry_message").append('<div class="container-msg-reply"><p>'+obj.replied_msg+'</p><span class="time-left"><small>'+obj.replied_by_name+" | "+obj.thread_date+'</small></span></div>');
				}
        });
	}).fail(function(datajson){
		
	});


	$.getJSON( "<?php echo e(url('inquiry/seen/')); ?>/"+id, function( datajson ) {

	}).done(function(datajson){
		//SEEN
	}).fail(function(datajson){
		
	});

	$("#inquireReplyModal").modal('toggle');
}
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('opac.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Joe\Documents\PCAARRD\elib\resources\views/opac/inquiries.blade.php ENDPATH**/ ?>