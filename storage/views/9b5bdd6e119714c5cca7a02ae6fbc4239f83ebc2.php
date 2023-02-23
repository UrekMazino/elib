

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('admin/nobleui/template/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css')); ?>">
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
                    <h6 class="card-title">PATRON</h6>
                    <div class="table-responsive">
                        <table id="tbl" class="table">
                          <thead>
                            <tr>
                              <th style="width:20%">Name</th>
                              <th>Contact No.</th>
                              <th>Email</th>
                              <th>Address</th>
                              <th>Date Registered</th>
                              <th></th>
                            </tr>
                          </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('admin/nobleui/template/assets/vendors/datatables.net/jquery.dataTables.js')); ?>"></script>
<script src="<?php echo e(asset('admin/nobleui/template/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js')); ?>"></script>
<script>
$(document).ready(function(){

// DataTable
$('#tbl').DataTable({
    processing: true,
    serverSide: true,
    ajax: '<?php echo e(url("/admin/patron/json")); ?>',
    columns: [
        { data: 'name' },
        { data: 'contactnum' },
        { data: 'email' },
        { data: 'location'},
        { data: 'created_at'},
        { 
          "data": function ( row, type, val, meta ) {
              return '<div class="btn-group" role="group"><button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button><div class="dropdown-menu" aria-labelledby="btnGroupDrop1"><a class="dropdown-item" href="#">Edit</a><a class="dropdown-item" href="#">Delete</a></div></div>'
          }
        
        },
    ]
});

});

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("admin.layouts.master", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Joe\Documents\PCAARRD\elib\resources\views/admin/patron.blade.php ENDPATH**/ ?>