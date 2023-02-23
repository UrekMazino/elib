

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('admin/nobleui/template/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css')); ?>">
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
                    <h6 class="card-title">INQUIRY</h6>
                    <div class="table-responsive">
                        <table id="tbl" class="table">
                          <thead>
                            <tr>
                              <th>Message</th>
                              <th>Title</th>
                              <th>User</th>
                              <th>Contact No.</th>
                              <th>Email</th>
                              <th>Replies</th>
                              <th>Date created</th>
                              <th></th>
                            </tr>
                          </thead>
                          <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lists): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                              <td><?php echo e($lists->message); ?></td>
                              <td><?php echo getTitle($lists->holdings_id); ?></td>
                              <td><?php echo e($lists->fullname); ?></td>
                              <td><?php echo e($lists->contactnum); ?></td>
                              <td><?php echo e($lists->email); ?></td>
                              <td align="center">
                                <?php if($lists->total_msg > 0): ?>
                                <span class="badge bg-danger"><?php echo e($lists->total_msg); ?></span>
                                <?php endif; ?>
                              </td>
                              <td><?php echo e($lists->created_at); ?></td>
                              <?php if($lists->user_id): ?>
                                <td style="width: 10%" align="center"><button class="btn btn-success btn-sm" onclick="replyInquiry(<?php echo e($lists->id); ?>,<?php echo e(Auth::user()->id); ?>)">Reply</td>
                              <?php else: ?>
                                <td align="center"><span class="muted">Guest User</span></td>
                              <?php endif; ?>
                            </tr>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="inquireReplyModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="title" id="smallModalLabel">Inquiry on this material</h4>
      </div>
      <form method="post" action="<?php echo e(url('/inquiry/reply')); ?>" id="frm_inquiry_reply">
      <?php echo csrf_field(); ?>
      <input type='hidden' name='holdings_id_inquiry_reply' id='holdings_id_inquiry_reply'>
      <div class="modal-body">

        <div id='inquiry_message'>
          
        </div>
        <span>Message : </span>
        <textarea class='form-control' name="inquiry_message_reply"></textarea>
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
<script src="<?php echo e(asset('admin/nobleui/template/assets/vendors/datatables.net/jquery.dataTables.js')); ?>"></script>
<script src="<?php echo e(asset('admin/nobleui/template/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js')); ?>"></script>
<script>

  function replyInquiry(id,userid)
  {
    $("#inquireReplyModal").modal('toggle');
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

  }

  

    $(function() {
  'use strict';

  $(function() {
    $('#tbl').DataTable();
  });

});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("admin.layouts.master", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\slims\resources\views/admin/inquiry.blade.php ENDPATH**/ ?>