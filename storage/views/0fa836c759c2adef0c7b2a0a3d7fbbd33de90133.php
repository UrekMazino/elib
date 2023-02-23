

<?php $__env->startSection('css'); ?>
    <!-- Plugin css for this page -->
	<link rel="stylesheet" href="<?php echo e(asset('admin/nobleui/template/assets/vendors/simplemde/simplemde.min.css')); ?>">
	<!-- End plugin css for this page -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline mb-4 mb-md-3">
                        <h6 class="card-title mb-0">NEWS ARTICLE</h6>
                    
                        <button type="submit" class="btn p-2 btn-primary" onclick="saveArticle()"al()">
                          <i class="icon-lg pb-3px text-white" data-feather="save"> </i> SAVE &nbsp&nbsp
                        </button>
                      </div>
                    <form method="post" action="<?php echo e(url('/admin/news/create')); ?>" id="frm_news" enctype="multipart/form-data">
                     <?php echo csrf_field(); ?>

                    <div class="mb-3">
                        <label for="news_title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="news_title" name="news_title" autocomplete="off" placeholder="">
                    </div>

                    <div class="mb-3">
                        <label for="news_cover" class="form-label">Cover photo (500 x 500)</label>
                        <input class="form-control" type="file" id="news_cover" name="news_cover">
                    </div>

                    <label for="news_body" class="form-label">Body</label>
                    <textarea class="form-control" name="news_body" id="tinymceExample" rows="10"></textarea>
                    </form>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>



<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('admin/nobleui/template/assets/vendors/datatables.net/jquery.dataTables.js')); ?>"></script>
<script src="<?php echo e(asset('admin/nobleui/template/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js')); ?>"></script>
<script src="<?php echo e(asset('admin/nobleui/template/assets/vendors/tinymce/tinymce.min.js')); ?>"></script>
<script>
$(function() {
  'use strict';

  //Tinymce editor
  if ($("#tinymceExample").length) {
    tinymce.init({
      selector: '#tinymceExample',
      height: 400,
      default_text_color: 'red',
      plugins: [
        'advlist autolink lists link image charmap print preview hr anchor pagebreak',
        'searchreplace wordcount visualblocks visualchars code fullscreen',
      ],
      toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
      toolbar2: 'print preview media | forecolor backcolor emoticons | codesample help',
      image_advtab: true,
      templates: [{
          title: 'Test template 1',
          content: 'Test 1'
        },
        {
          title: 'Test template 2',
          content: 'Test 2'
        }
      ],
      content_css: []
    });
  }
  
});


function saveArticle()
{
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonClass: 'me-2',
      confirmButtonText: 'Yes',
      cancelButtonText: 'No',
      reverseButtons: true
    }).then((result) => {
      if (result.value) {
        $("#modalSaving").modal("toggle"); 
        $('#frm_news').submit();
      } else if (
        // Read more about handling dismissals
        result.dismiss === Swal.DismissReason.cancel
      ) {
        Swal.fire(
          'Cancelled',
          'Your news article is safe :)',
          'error'
        )
      }
    })
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("admin.layouts.master", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\slims\resources\views/admin/add-news.blade.php ENDPATH**/ ?>