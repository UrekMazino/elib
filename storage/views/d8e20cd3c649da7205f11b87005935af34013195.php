<div class="col-3">
<div class="widget">
                    <form method="get" action="<?php echo e(url('/results')); ?>" id="frm">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="page" value="1">
                        <input type="hidden" name="series_statement_id" value="0">
                        <input type="hidden" name="layout" value="grid">
                        <input type="hidden" value="all-material" id="checkAll" name="seachtype[]">
							<div class="form-group">
								<input type="text" name="query" id="query" class="form-control" placeholder="Search...">
							</div>
							<button type="submit" id="submit" class="btn_1"> Search</button>
						</form>
					</div>
					<!-- /widget -->

					<div class="widget">
						<div class="widget-title">
							<h4>Recent News</h4>
						</div>
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
</div><?php /**PATH D:\xampp\htdocs\slims\resources\views/opac/side.blade.php ENDPATH**/ ?>