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
	<link rel="stylesheet" href="<?php echo e(asset('admintemplate/nobleui/template/assets/vendors/core/core.css')); ?>">
	<!-- endinject -->

	<!-- Plugin css for this page -->
  <link rel="stylesheet" href="<?php echo e(asset('admintemplate/nobleui/template/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css')); ?>">
	<!-- End plugin css for this page -->

    <?php echo $__env->yieldContent('css'); ?>

	<!-- inject:css -->
  <link rel="stylesheet" href="<?php echo e(asset('admintemplate/nobleui/template/assets/vendors/mdi/css/materialdesignicons.min.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('admintemplate/nobleui/template/assets/fonts/feather-font/css/iconfont.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('admintemplate/nobleui/template/assets/vendors/flag-icon-css/css/flag-icon.min.css')); ?>">
	<!-- endinject -->

  <link rel="stylesheet" href="<?php echo e(asset('admintemplate/nobleui/template/assets/vendors/sweetalert2/sweetalert2.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('admintemplate/nobleui/template/assets/vendors/select2/select2.min.css')); ?>">

  <!-- Layout styles -->  
	<link rel="stylesheet" href="<?php echo e(asset('admintemplate/nobleui/template/assets/css/demo1/style.css')); ?>">
  <!-- End layout styles -->

  	<!-- Favicons-->
	<link rel="shortcut icon" href="<?php echo e(asset('assets/images/elibrary-02.png')); ?>">
	<link rel="apple-touch-icon" type="image/x-icon" href="<?php echo e(asset('opac/img/apple-touch-icon-57x57-precomposed.png')); ?>">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="<?php echo e(asset('opac/img/apple-touch-icon-72x72-precomposed.png')); ?>">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="<?php echo e(asset('opac/img/apple-touch-icon-114x114-precomposed.png')); ?>">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="<?php echo e(asset('opac/img/apple-touch-icon-144x144-precomposed.png')); ?>">

</head>
<body class="sidebar-dark">
	<div class="main-wrapper">

		<!-- partial:partials/_sidebar.html -->
		<nav class="sidebar">
      <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
           <img src="<?php echo e(asset("assets/images/elibrary-04.png")); ?>" width="100" alt="" />
        </a>
        <div class="sidebar-toggler not-active">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </div>
      <div class="sidebar-body">
        <ul class="nav">
          
          <li class="nav-item nav-category">Menu</li>
          <li class="nav-item">
            <a href="<?php echo e(url('/admin/dashboard')); ?>" class="nav-link">
              <i class="link-icon" data-feather="box"></i>
              <span class="link-title">Dashboard</span>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?php echo e(url('/admin/inquiry')); ?>" class="nav-link">
              <i class="link-icon" data-feather="info"></i>
              <span class="link-title">Inquiries</span>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?php echo e(url('/admin/news')); ?>" class="nav-link">
              <i class="link-icon"><i class="mdi mdi-newspaper"></i></i>
              <span class="link-title">News Article</span>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?php echo e(url('/admin/report')); ?>" class="nav-link">
              <i class="link-icon"><i class="mdi mdi-chart-bar"></i></i>
              <span class="link-title">Reports</span>
            </a>
          </li>

          <li class="nav-item nav-category">Holdings</li>
          <li class="nav-item">
            <a href="<?php echo e(url('/admin/new-acquisition')); ?>" class="nav-link">
              <i class="link-icon"><i class="mdi mdi-book-plus"></i></i>
              <span class="link-title">New</span>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?php echo e(url('/admin/catalog')); ?>" class="nav-link">
              <i class="link-icon"><i class="mdi mdi-bookmark-plus"></i></i>
              <span class="link-title">Catalog</span>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?php echo e(url('/admin/uncat')); ?>" class="nav-link">
              <i class="link-icon"><i class="mdi mdi-bookmark-remove"></i></i>
              <span class="link-title">Uncatalog</span>
            </a>
          </li>

          

          <li class="nav-item nav-category">Circulation</li>
          <li class="nav-item">
            <a href="<?php echo e(url('/admin/borrowed')); ?>" class="nav-link">
              <i class="link-icon" data-feather="book"></i>
              <span class="link-title">Borrowed Materials</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo e(url('/admin/visits')); ?>" class="nav-link">
              <i class="link-icon" data-feather="map"></i>
              <span class="link-title">Visitor</span>
            </a>
          </li>


          <li class="nav-item nav-category">Accounts</li>
          <li class="nav-item">
            <a href="<?php echo e(url('/admin/users')); ?>" class="nav-link">
              <i class="link-icon" data-feather="users"></i>
              <span class="link-title">Users</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo e(url('/admin/patron')); ?>" class="nav-link">
              <i class="link-icon" data-feather="users"></i>
              <span class="link-title">Patron</span>
            </a>
          </li>

        </ul>
      </div>
    </nav>
    
		<!-- partial -->
	
		<div class="page-wrapper">
					
			<!-- partial:partials/_navbar.html -->
			<nav class="navbar">
				<a href="#" class="sidebar-toggler">
					<i data-feather="menu"></i>
				</a>
				<div class="navbar-content">
					<form class="search-form">
						<div class="input-group">
              
						</div>
					</form>
					<ul class="navbar-nav">

						
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i data-feather="bell"></i>
								
							</a>
							<div class="dropdown-menu p-0" aria-labelledby="notificationDropdown">
								<div class="px-3 py-2 d-flex align-items-center justify-content-between border-bottom">
									<p>6 New Notifications</p>
								</div>
                <div class="p-1">
                  <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
                    <div class="wd-30 ht-30 d-flex align-items-center justify-content-center bg-primary rounded-circle me-3">
											<i class="icon-sm text-white" data-feather="gift"></i>
                    </div>
                    <div class="flex-grow-1 me-2">
											<p>New Order Recieved</p>
											<p class="tx-12 text-muted">30 min ago</p>
                    </div>	
                  </a>
                  <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
                    <div class="wd-30 ht-30 d-flex align-items-center justify-content-center bg-primary rounded-circle me-3">
											<i class="icon-sm text-white" data-feather="alert-circle"></i>
                    </div>
                    <div class="flex-grow-1 me-2">
											<p>Server Limit Reached!</p>
											<p class="tx-12 text-muted">1 hrs ago</p>
                    </div>	
                  </a>
                  <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
                    <div class="wd-30 ht-30 d-flex align-items-center justify-content-center bg-primary rounded-circle me-3">
                      <img class="wd-30 ht-30 rounded-circle" src="https://via.placeholder.com/30x30" alt="userr">
                    </div>
                    <div class="flex-grow-1 me-2">
											<p>New customer registered</p>
											<p class="tx-12 text-muted">2 sec ago</p>
                    </div>	
                  </a>
                  <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
                    <div class="wd-30 ht-30 d-flex align-items-center justify-content-center bg-primary rounded-circle me-3">
											<i class="icon-sm text-white" data-feather="layers"></i>
                    </div>
                    <div class="flex-grow-1 me-2">
											<p>Apps are ready for update</p>
											<p class="tx-12 text-muted">5 hrs ago</p>
                    </div>	
                  </a>
                  <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
                    <div class="wd-30 ht-30 d-flex align-items-center justify-content-center bg-primary rounded-circle me-3">
											<i class="icon-sm text-white" data-feather="download"></i>
                    </div>
                    <div class="flex-grow-1 me-2">
											<p>Download completed</p>
											<p class="tx-12 text-muted">6 hrs ago</p>
                    </div>	
                  </a>
                </div>
								<div class="px-3 py-2 d-flex align-items-center justify-content-center border-top">
									<a href="javascript:;">View all</a>
								</div>
							</div>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<img class="wd-30 ht-30 rounded-circle" src="<?php echo e(asset('admintemplate/nobleui/template/assets/images/profile.jpg')); ?>" alt="profile">
							</a>
							<div class="dropdown-menu p-0" aria-labelledby="profileDropdown">
								<div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
									<div class="mb-3">
										<img class="wd-80 ht-80 rounded-circle" src="<?php echo e(asset('admintemplate/nobleui/template/assets/images/profile.jpg')); ?>" alt="">
									</div>
									<div class="text-center">
										<p class="tx-16 fw-bolder"><?php echo e(Auth::user()->name); ?></p>
									</div>
								</div>
                <ul class="list-unstyled p-1">
                  
                  <li class="dropdown-item py-2">
                    <form method="POST" id="frmLogout" action="<?php echo e(route('logout')); ?>">
                        <?php echo csrf_field(); ?>
                    </form>
                        <a href="javascript:;" class="text-body ms-0" onclick="event.preventDefault();
                                        getElementById('frmLogout').submit();"><i class="me-2 icon-md" data-feather="log-out"></i>
                      <span>Log Out</span></a>
                        </a>
                  </li>
                </ul>
							</div>
						</li>
					</ul>
				</div>
			</nav>
			<!-- partial -->

			<?php echo $__env->yieldContent('content'); ?>

			<!-- partial:partials/_footer.html -->
			<footer class="footer d-flex flex-column flex-md-row align-items-center justify-content-between px-4 py-3 border-top small">
				<p class="text-muted mb-1 mb-md-0">Copyright © 2022 <a href="https://www.nobleui.com" target="_blank">PCAARRD eLibrary</a>.</p>
				
			</footer>
			<!-- partial -->
		
		</div>
	</div>

  <!-- Modal -->
  <div class="modal hide fade in" data-keyboard="false" data-backdrop="static" id="modalSaving" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body">
          <div class="d-flex align-items-center">
            <strong>Saving...Please wait</strong>
            <div class="spinner-border text-success ms-auto" role="status" aria-hidden="true"></div>
          </div>
        </div>
      </div>
    </div>
  </div>

	<!-- core:js -->
	<script src="<?php echo e(asset('admintemplate/nobleui/template/assets/vendors/core/core.js')); ?>"></script>
	<!-- endinject -->

	<!-- Plugin js for this page -->
  <script src="<?php echo e(asset('admintemplate/nobleui/template/assets/vendors/chartjs/Chart.min.js')); ?>"></script>
  <script src="<?php echo e(asset('admintemplate/nobleui/template/assets/vendors/jquery.flot/jquery.flot.js')); ?>"></script>
  <script src="<?php echo e(asset('admintemplate/nobleui/template/assets/vendors/jquery.flot/jquery.flot.resize.js')); ?>"></script>
  <script src="<?php echo e(asset('admintemplate/nobleui/template/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js')); ?>"></script>
  <script src="<?php echo e(asset('admintemplate/nobleui/template/assets/vendors/apexcharts/apexcharts.min.js')); ?>"></script>
	<!-- End plugin js for this page -->

  <script src="<?php echo e(asset('admintemplate/nobleui/template/assets/vendors/select2/select2.min.js')); ?>"></script>
    <?php echo $__env->yieldContent('js'); ?>

	<!-- inject:js -->
	<script src="<?php echo e(asset('admintemplate/nobleui/template/assets/vendors/feather-icons/feather.min.js')); ?>"></script>
	<script src="<?php echo e(asset('admintemplate/nobleui/template/assets/js/template.js')); ?>"></script>
	<!-- endinject -->

  <script src="<?php echo e(asset('admintemplate/nobleui/template/assets/vendors/sweetalert2/sweetalert2.min.js')); ?>"></script>


	<!-- Custom js for this page -->
  <script src="<?php echo e(asset('admintemplate/nobleui/template/assets/js/dashboard-light.js')); ?>"></script>
  <script src="<?php echo e(asset('admintemplate/nobleui/template/assets/js/datepicker.js')); ?>"></script>
	<!-- End custom js for this page -->

  <script>

  </script>

</body>
</html>    <?php /**PATH C:\Users\Joe\Documents\PCAARRD\elib\resources\views/admin/layouts/master.blade.php ENDPATH**/ ?>