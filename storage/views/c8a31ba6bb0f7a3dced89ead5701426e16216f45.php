<!DOCTYPE html>
<!--
Template Name: NobleUI - HTML Bootstrap 5 Admin Dashboard Template
Author: NobleUI
Website: https://www.nobleui.com
Portfolio: https://themeforest.net/user/nobleui/portfolio
Contact: nobleui123@gmail.com
Purchase: https://1.envato.market/nobleui_admin
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5">
	<meta name="author" content="NobleUI">
	<meta name="keywords" content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<title>PCAARRD eLibrary</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
  <!-- End fonts -->

	<!-- core:css -->
	<link rel="stylesheet" href="<?php echo e(asset('admin/nobleui/template/assets/vendors/bootstrap5/css/bootstrap.min.css')); ?>">
	<!-- endinject -->

	<!-- Plugin css for this page -->
  <link rel="stylesheet" href="<?php echo e(asset('admin/nobleui/template/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css')); ?>">
	<!-- End plugin css for this page -->

    <link rel="stylesheet" href="<?php echo e(asset('admin/nobleui/template/assets/vendors/DataTables/DataTables-1.12.1/css/dataTables.bootstrap5.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('admin/nobleui/template/assets/vendors/DataTables/buttons/css/buttons.bootstrap5.min.css')); ?>">

	<!-- inject:css -->
	<link rel="stylesheet" href="<?php echo e(asset('admin/nobleui/template/assets/fonts/feather-font/css/iconfont.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('admin/nobleui/template/assets/vendors/flag-icon-css/css/flag-icon.min.css')); ?>">
	<!-- endinject -->

  	<!-- Favicons-->
	<link rel="shortcut icon" href="<?php echo e(asset('assets/images/elibrary-02.png')); ?>">
	<link rel="apple-touch-icon" type="image/x-icon" href="<?php echo e(asset('opac/img/apple-touch-icon-57x57-precomposed.png')); ?>">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="<?php echo e(asset('opac/img/apple-touch-icon-72x72-precomposed.png')); ?>">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="<?php echo e(asset('opac/img/apple-touch-icon-114x114-precomposed.png')); ?>">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="<?php echo e(asset('opac/img/apple-touch-icon-144x144-precomposed.png')); ?>">

    
</head>
<body>
    <div class="container-fluid p-3">
        <div class="row">
            <div class="col-12">
                <?php if($table == 1): ?>
                <table class="table" id="tbl">
                    <thead>
                        <th>#</th>
                        <th>Title</th>
                        <th>Authors</th>
                        <th>Material Type</th>
                        <th>Call No.</th>
                        <th>General Notes</th>
                        <th>Subject</th>
                        <th>Source</th>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lists): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td></td>
                                <td><?php echo e(formatTitle1($lists->title_statement)); ?></td>
                                <td><?php echo e($lists->joint_authors); ?></td>
                                <td><?php echo e($lists->material); ?></td>
                                <td><?php echo e($lists->call_number); ?></td>
                                <td><?php echo e($lists->general_note); ?></td>
                                <td></td>
                                <td><?php echo e($lists->consortia); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <?php elseif($table == 2): ?>
                <table class="table" id="tbl">
                    <thead>
                        <th>#</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Contact No.</th>
                        <th>Email</th>
                        <th>Location</th>
                        <th>Date Registered</th>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lists): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td></td>
                                <td><?php echo e($lists->name); ?></td>
                                <td><?php echo e($lists->username); ?></td>
                                <td><?php echo e($lists->contactnum); ?></td>
                                <td><?php echo e($lists->email); ?></td>
                                <td><?php echo e($lists->location); ?></td>
                                <td><?php echo e($lists->created_at); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <?php elseif($table == 3): ?>
                <table class="table" id="tbl">
                    <thead>
                        <th>#</th>
                        <th>Inquiry</th>
                        <th>Material</th>
                        <th>Name</th>
                        <th>Contact No.</th>
                        <th>Email</th>
                        <th>Date</th>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lists): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td></td>
                                <td><?php echo e($lists->message); ?></td>
                                <td><?php echo e(formatTitle1($lists->title_statement)); ?></td>
                                <td><?php echo e($lists->fullname); ?></td>
                                <td><?php echo e($lists->contactnum); ?></td>
                                <td><?php echo e($lists->email); ?></td>
                                <td><?php echo e($lists->created_at); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <?php elseif($table == 5): ?>
                <table class="table" id="tbl">
                    <thead>
                        <th>#</th>
                        <th>Responsiveness</th>
                        <th>Reliability (Quality)</th>
                        <th>Access & Facilities</th>
                        <th>Communication</th>
                        <th>Integrity</th>
                        <th>Assurance</th>
                        <th>Outcome</th>
                        <th>Date Accomplished</th>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lists): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td></td>
                                <td><?php echo e($lists->rating1); ?></td>
                                <td><?php echo e($lists->rating2); ?></td>
                                <td><?php echo e($lists->rating3); ?></td>
                                <td><?php echo e($lists->rating4); ?></td>
                                <td><?php echo e($lists->rating5); ?></td>
                                <td><?php echo e($lists->rating6); ?></td>
                                <td><?php echo e($lists->rating7); ?></td>
                                <td><?php echo e($lists->created_at); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>

<script src="<?php echo e(asset('js/jquery-3.6.0.min.js')); ?>"></script>
<script src="<?php echo e(asset('admin/nobleui/template/assets/vendors/bootstrap5/js/bootstrap.bundle.min.js')); ?>"></script>

<script src="<?php echo e(asset('admin/nobleui/template/assets/vendors/DataTables/DataTables-1.12.1/js/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('admin/nobleui/template/assets/vendors/DataTables/DataTables-1.12.1/js/dataTables.bootstrap5.min.js')); ?>"></script>

<script src="<?php echo e(asset('admin/nobleui/template/assets/vendors/DataTables/buttons/js/dataTables.buttons.min.js')); ?>"></script>
<script src="<?php echo e(asset('admin/nobleui/template/assets/vendors/DataTables/buttons/js/buttons.bootstrap5.min.js')); ?>"></script>
<script src="<?php echo e(asset('admin/nobleui/template/assets/vendors/DataTables/buttons/js/buttons.html5.min.js')); ?>"></script>
<script src="<?php echo e(asset('admin/nobleui/template/assets/vendors/DataTables/buttons/js/jszip.min.js')); ?>"></script>
<script src="<?php echo e(asset('admin/nobleui/template/assets/vendors/DataTables/buttons/js/buttons.print.min.js')); ?>"></script>


<script>
$(document).ready(function() {
    var t = $('#tbl').DataTable( {
        dom: 'Bfrtip',
        buttons: [
                    {
                        extend: 'excelHtml5',
                        text: 'Export to Excel',
                    }    
            ],
    } );

    t.on('order.dt search.dt', function () {
        let i = 1;
 
        t.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
            this.data(i++);
        });
    }).draw();
} );
</script>
</html><?php /**PATH C:\Users\Joe\Documents\PCAARRD\elib\resources\views/admin/print-report.blade.php ENDPATH**/ ?>