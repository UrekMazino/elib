

<?php $__env->startSection('css'); ?>
    
    <link rel="stylesheet" href="<?php echo e(asset('admin/nobleui/template/assets/vendors/DataTables/DataTables-1.12.1/css/dataTables.bootstrap5.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('admin/nobleui/template/assets/vendors/DataTables/buttons/css/buttons.bootstrap5.min.css')); ?>">

    <style>
      table td {
        word-break: break-word;
        vertical-align: top;
        white-space: normal !important;
      }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                  <div class="d-flex justify-content-between align-items-baseline mb-4 mb-md-3">
                    <h6 class="card-title mb-0">ACQUISITION</h6>
                    <a href="<?php echo e(url('/admin/new-acquisition')); ?>" class="btn p-2 btn-success" type="button">
                      <i class="icon-lg pb-3px text-white" data-feather="file-plus"> </i> ADD RECORD
                    </a>
                  </div>

                    <div class="table-responsive">
                        <table id="tbl" class="table">
                          <thead>
                            <tr>
                              <th style="width: 10%">ID</th>
                              <th style="width: 35%">Title</th>
                              <th>Material Type</th>
                              <th>Authors</th>
                              <th style="width: 10%">Status</th>
                              <th>Source</th>
                              <th>Created by</th>
                              <th style="width: 10%">Date created</th>
                              <th style="width: 10%" align="center"></th>
                            </tr>
                          </thead>
                         
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="shareModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="title" id="smallModalLabel">Share material</h4>
      </div>
      <form method="post" action="<?php echo e(url('/acquisition/shared')); ?>" id="frm_share">
      <?php echo csrf_field(); ?>
      <input type='hidden' name='holdings_id_share' id='holdings_id_share'>
      <div class="modal-body">
        <div class="mb-4">
          <div class="form-check mb-2">
            <input type="checkbox" class="form-check-input" id="consortia-all" checked>
            <label class="form-check-label" for="consortia-all">
              All
            </label>
          </div>
        <?php $__currentLoopData = getConsortia(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="form-check mb-2">
            <input type="checkbox" class="form-check-input consortia" id="<?php echo e($list->description); ?>">
            <label class="form-check-label" for="<?php echo e($list->description); ?>">
              <?php echo e($list->description); ?>

            </label>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-info">Submit</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">CLOSE</button>
      </div>
      </form>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>


<script src="<?php echo e(asset('admin/nobleui/template/assets/vendors/DataTables/DataTables-1.12.1/js/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('admin/nobleui/template/assets/vendors/DataTables/DataTables-1.12.1/js/dataTables.bootstrap5.min.js')); ?>"></script>

<script src="<?php echo e(asset('admin/nobleui/template/assets/vendors/DataTables/buttons/js/dataTables.buttons.min.js')); ?>"></script>
<script src="<?php echo e(asset('admin/nobleui/template/assets/vendors/DataTables/buttons/js/buttons.bootstrap5.min.js')); ?>"></script>
<script src="<?php echo e(asset('admin/nobleui/template/assets/vendors/DataTables/buttons/js/buttons.colVis.min.js')); ?>"></script>
<script src="<?php echo e(asset('admin/nobleui/template/assets/vendors/DataTables/buttons/js/buttons.html5.min.js')); ?>"></script>
<script src="<?php echo e(asset('admin/nobleui/template/assets/vendors/DataTables/buttons/js/buttons.print.min.js')); ?>"></script>

<script>

$(document).ready(function(){

// DataTable
$('#tbl').DataTable({
    processing: true,
    serverSide: true,
    ajax: '<?php echo e(url("/admin/acquisition/json")); ?>',
    columns: [
        { data: 'holdings_id' },
        { data: 'title_statement' },
        { data: 'material' },
        { data: 'joint_authors'},
        { data: 'catalog_status' },
        { data: 'consortia' },
        { data: 'CreatedBy' },
        { data: 'createdat' },
        { 
          "data": function ( row, type, val, meta ) {
              return '<div class="btn-group" role="group"><button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button><div class="dropdown-menu" aria-labelledby="btnGroupDrop1"><a class="dropdown-item" href="#">Edit</a><a class="dropdown-item" href="#">Delete</a><a class="dropdown-item" href="#">Set as inactive</a><a class="dropdown-item" href="#" onclick="shareMaterial('+row.id+')">Share material</a></div></div>'
          }
        
        },
    ]
});

});

function shareMaterial(id)
{
  $('.consortia').not(this).prop('checked', false);
  $('#consortia-all').prop('checked', true);
  $("#shareModal").modal('toggle');
}

$("#consortia-all").click(function () {
     $('.consortia').not(this).prop('checked', false);
     $(this).prop('checked', true);
 });

 

 $(".consortia").click(function () {
     $('#consortia-all').prop('checked', false);
 });

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("admin.layouts.master", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\slims\resources\views/admin/acquisition.blade.php ENDPATH**/ ?>