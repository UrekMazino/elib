

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
                    <h6 class="card-title">BORROWED MATERIALS</h6>
                    <div class="table-responsive">
                        <table id="tbl" class="table">
                          <thead>
                            <tr>
                              <th style="width: 25%">Material Title</th>
                              <th style="width: 15%">Patron</th>
                              <th>Status</th>
                              <th>Date Requested</th>
                              <th>Date Approved</th>
                              <th>Date Returned</th>
                              <th>Approved by</th>
                              <th>No. of Days</th>
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

<form method="post" action="<?php echo e(url('/admin/borrowed/action')); ?>" id="frm">
	<?php echo csrf_field(); ?>
	<input type="hidden" class="form-control" name="borrowed_id" id="borrowed_id" value="">
  <input type="hidden" class="form-control" name="borrowed_action" id="borrowed_action" value="">
</form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('admin/nobleui/template/assets/vendors/datatables.net/jquery.dataTables.js')); ?>"></script>
<script src="<?php echo e(asset('admin/nobleui/template/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js')); ?>"></script>
<script>
$('#tbl').DataTable({
    processing: true,
    serverSide: true,
    ajax: '<?php echo e(url("/admin/borrowed/json")); ?>',
    columns: [
        { data: 'title_statement' },
        { data: 'fullname' },
        { data: 'status'},
        { data: 'request_at_string' },
        { data: 'approved_at_string' },
        { data: 'returned_at_string' },
        { data: 'approved_by' },
        { data: 'total_days' },
        { 
          "data": function ( row, type, val, meta ) {
              if(row.status == 'For Approval')
                return '<div class="btn-group" role="group"><button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button><div class="dropdown-menu" aria-labelledby="btnGroupDrop1"><a class="dropdown-item" href="#" onclick="approvedBorrowed(1,'+row.id+')">Approve</a><a class="dropdown-item" href="#" onclick="approvedBorrowed(2,'+row.id+')">Delete</a></div></div>';
              if(row.status == 'Returned')
                return null;
              else
                return '<div class="btn-group" role="group"><button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button><div class="dropdown-menu" aria-labelledby="btnGroupDrop1"><a class="dropdown-item" href="#" onclick="approvedBorrowed(3,'+row.id+')">Returned</a></div></div>';
                
          }
        
        },
    ]
});


function approvedBorrowed(status,id)
{
  $("#borrowed_id").val(id);
  $("#borrowed_action").val(status);

  $("#frm").submit();
}

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("admin.layouts.master", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Joe\Documents\PCAARRD\elib\resources\views/admin/borrowed.blade.php ENDPATH**/ ?>