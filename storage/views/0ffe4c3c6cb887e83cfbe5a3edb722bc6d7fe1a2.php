<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Find easily a doctor and book online an appointment">
	<meta name="author" content="Ansonika">
	<meta name="csrf_token" content="<?php echo e(csrf_token()); ?>">

	<title>PCAARRD eLibrary</title>

	<!-- Favicons-->
	<link rel="shortcut icon" href="<?php echo e(asset('assets/images/elibrary-02.png')); ?>">
	<link rel="apple-touch-icon" type="image/x-icon" href="<?php echo e(asset('opac/img/apple-touch-icon-57x57-precomposed.png')); ?>">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="<?php echo e(asset('opac/img/apple-touch-icon-72x72-precomposed.png')); ?>">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="<?php echo e(asset('opac/img/apple-touch-icon-114x114-precomposed.png')); ?>">
	<link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="<?php echo e(asset('opac/img/apple-touch-icon-144x144-precomposed.png')); ?>">

	<!-- DataTables-->
	<!-- <link href="<?php echo e(asset('opac/DataTables/Bulma-0.9.2/css/bulma.min.css')); ?>" rel="stylesheet"> -->
	<link href="<?php echo e(asset('opac/DataTables/DataTables-1.12.1/css/dataTables.bootstrap5.min.css')); ?>" rel="stylesheet">
	
    
    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
	<!-- BASE CSS -->
	<link href="<?php echo e(asset('opac/css/bootstrap.min.css')); ?>" rel="stylesheet">
	<link href="<?php echo e(asset('opac/css/style.css')); ?>" rel="stylesheet">
	<link href="<?php echo e(asset('opac/css/menu.css')); ?>" rel="stylesheet">
	<link href="<?php echo e(asset('opac/css/vendors.css')); ?>" rel="stylesheet">
	<link href="<?php echo e(asset('opac/css/icon_fonts/css/all_icons_min.css')); ?>" rel="stylesheet">

	<link href="<?php echo e(asset('opac/css/blog.css')); ?>" rel="stylesheet">
    
	<!-- YOUR CUSTOM CSS -->
	<link href="<?php echo e(asset('opac/css/custom.css')); ?>" rel="stylesheet">
	<link href="<?php echo e(asset('opac/css/stars.css')); ?>" rel="stylesheet">



	<?php echo $__env->yieldContent('css'); ?>

</head>

<body>

	<div class="layer"></div>
	<!-- Mobile menu overlay mask -->

	<div id="preloader">
		<div data-loader="circle-side"></div>
	</div>
	<!-- End Preload -->
    
	<header class="header_sticky">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-6">
					<div id="logo_home">
						<h1><a href="<?php echo e(url('/home')); ?>" title="Findoctor">SLIMS</a></h1>
					</div>
				</div>
				<nav class="col-lg-9 col-6">
					<a class="cmn-toggle-switch cmn-toggle-switch__htx open_close" href="#0"><span>Menu mobile</span></a>
					<div class="main-menu">
						<ul>
							<?php if(auth()->guard()->check()): ?>
							<li class="submenu">
								<a href="#0" class="show-submenu">Welcome, <?php echo e(Auth::user()->name); ?> <i class="icon-down-open-mini"></i></a>
								<ul>
									<li><a href="<?php echo e(url('/home')); ?>">Home</a></li>
									<li><a href="<?php echo e(url('/profile')); ?>">My Profile</a></li>
									<li><a href="<?php echo e(url('/barrowed')); ?>">Borrowed Materials</a></li>
									<li><a href="<?php echo e(url('/inquiries')); ?>">Inquiries <?php echo getNotif('inquiry'); ?></a></li>
									<li><a href="<?php echo e(url('/to-review')); ?>">To Review <?php echo getNotif('review'); ?></a></li>
									<form method="POST" id="frmLogout" action="<?php echo e(route('logout')); ?>">
		                                <?php echo csrf_field(); ?>
		                            </form>
									<li onclick="event.preventDefault();
                                                getElementById('frmLogout').submit();"><a href="#">Logout</a></li>
								</ul>

							</li>
							<?php else: ?>
							<li class="submenu">
								<a href="<?php echo e(url('login')); ?>"><i class="pe-7s-user" style="font-size: 30px !important;vertical-align: middle;"></i>&nbsp&nbspLogin</a>
							</li>
							<?php endif; ?>
						</ul>
						<?php echo getNotif('overall'); ?>

					</div>
					<!-- /main-menu -->

				</nav>
			</div>
		</div>
		<!-- /container -->
	</header>
	<!-- /header -->
	
	<main>
	<?php echo $__env->yieldContent('content'); ?>

	</main>
	<!-- /main content -->
	
	<footer>
		<div class="container margin_60_35">
			<div class="row">
				<!-- <div class="col-lg-3 col-md-12">
					<p>
						<a href="index.html" title="Findoctor">
							<img src="<?php echo e(asset('opac/img/elibrary-04.png')); ?>" alt="" width="200"class="img-fluid">
						</a>
					</p>
				</div> -->
				<div class="col-lg-3 col-md-4">
					<h5>Local Resources</h5>
					<ul class="links">
						<li><a href="https://bar.gov.ph/index.php/media-resources/publications" target="_blank">Department of Agriculture</a></li>
						<li><a href="http://www.bsu.edu.ph/shamag#:~:text=Shamag%2C%20an%20Ibaloi%20term%20that,communication%20tool%20among%20BSU%20constituents." target="_blank">Benguet State University</a></li>
						<li><a href="https://www.pids.gov.ph/publications" target="_blank">Philippine Institute for Development Studies</a></li>
						<li><a href="https://fprdi.dost.gov.ph/22-publications" target="_blank">DOST-FPRDI</a></li>
					</ul>
				</div>
				<div class="col-lg-3 col-md-4">
					<h5>International Resources</h5>
					<ul class="links">
						<li><a href="https://repository.seafdec.org.ph/" target="_blank">Southeast Asian Fisheries Development Center/Aquaculture Department (SEAFDEC/AQD)</a></li>
						<li><a href="https://www.jircas.go.jp/en/publication/list/jarq" target="_blank">Japan International Research Center for Agricultural Sciences (JIRCAS)</a></li>
						<li><a href="https://www.aciar.gov.au/publication-search" target="_blank">Australian Centre for International Agricultural Research</a></li>
						
						<li><a href="http://www.apaari.org/web/what-we-do/apcoab/publications/" target="_blank">Asia-Pacific Association of Agricultural Research Institutions</a></li>
					</ul>
				</div>
				<div class="col-lg-3 col-md-4">
					<h5>&nbsp</h5>
					<ul class="links">
						<li><a href="https://www.rural21.com/english/publications.html" target="_blank">RURAL 21</a></li>
						<li><a href="https://www.fao.org/publications/en/" target="_blank">Food and Agriculture Organization of the United Nations</a></li>
						<li><a href="https://www.dandc.eu/en/archive" target="_blank">D+C Development and Cooperation</a></li>
						<li><a href="https://www.fftc.org.tw/en/publications" target="_blank">Food and Fertilizer Technology Center</a></li>
						<li><a href="https://www.searca.org/pubs" target="_blank">Southeast Asian Regional Center for Graduate Study and Research in Agriculture (SEARCA)</a></li>
					</ul>
				</div>
				<div class="col-lg-3 col-md-4">
					<h5>Contact with Us</h5>
					<ul class="contacts">
						<li><a href="tel://61280932400"><i class="icon_mobile"></i> + 61 23 8093 3400</a></li>
						<li><a href="mailto:info@findoctor.com"><i class="icon_mail_alt"></i> elibrary@pcaarrd.gov.ph</a></li>
					</ul>
					<div class="follow_us">
						<h5>Follow us</h5>
						<ul>
							<li><a href="https://www.facebook.com/PCAARRD" target="_blank"><i class="social_facebook"></i></a></li>
							<li><a href="https://twitter.com/dostpcaarrd" target="_blank"><i class="social_twitter"></i></a></li>
							<li><a href="https://www.linkedin.com/company/pcaarrd?original_referer=https%3A%2F%2Felibrary.pcaarrd.dost.gov.ph%2F" target="_blank"><i class="social_linkedin"></i></a></li>
							<li><a href="#0"><i class="social_instagram"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
			<!--/row-->
			<hr>
			<div class="row">
				<div class="col-md-8">
					<ul id="additional_links">
						<li><a href="#" data-bs-toggle="modal" data-bs-target="#modalTerms">Terms and conditions</a></li>
						<li><a href="#" data-bs-toggle="modal" data-bs-target="#modalPrivacy">Privacy</a></li>
					</ul>
				</div>
				<div class="col-md-4">
					<div id="copy">© 2022 eLibrary - PCAARRD</div>
				</div>
			</div>
		</div>
	</footer>
	<!--/footer-->

	<!-- <div id="toTop"></div> -->
	<!-- Back to top button -->

	<div class="modal" id="modalTerms" tabindex="-1">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title text-info">Terms and conditions</h5>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">
	        <p><span class="text-success">Lorem ipsum dolor sit amet</span> consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
	      </div>
	    </div>
	  </div>
	</div>

	<div class="modal" id="modalPrivacy" tabindex="-1">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title text-info">Privacy</h5>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">
	        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>
	      </div>
	    </div>
	  </div>
	</div>

	<div class="modal fade" id="inquireModal" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="title" id="smallModalLabel">Inquiry on this material</h4>
				</div>
				<form method="post" action="<?php echo e(url('/inquiry/submit')); ?>" id="frm_inquiry">
				<?php echo csrf_field(); ?>
				<input type='hidden' name='holdings_id_inquiry' id='holdings_id_inquiry'>
				<div class="modal-body">
					<?php if(!Auth::check()): ?>
					<div class="row">
									<div class="col-12">
										<div class="form-group">
											<span>Fullname : </span>
											<input class="form-control" name="inquiry_fullname" type="text" data-lang="en" placeholder="" required>
										</div>
									</div>
									<div class="col-12">
										<div class="form-group">
											<span>Contact number : </span>
											<input class="form-control" name="inquiry_contactnum" type="text" placeholder="">
										</div>
									</div>
									<div class="col-12">
										<div class="form-group">
										<span>Email : </span>
											<input class="form-control" name="inquiry_email" type="email" placeholder="">
										</div>
									</div>
								</div>
					<?php endif; ?>
					<span>Message : </span>
					<textarea class='form-control' name="inquiry_message"></textarea>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-info">Submit</button>
					<button type="button" class="btn btn-danger" data-bs-dismiss="modal">CLOSE</button>
				</div>
				</form>
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

	<!-- COMMON SCRIPTS -->
	<script src="<?php echo e(asset('opac/js/jquery-3.6.0.min.js')); ?>"></script>
	<script src="<?php echo e(asset('opac/js/common_scripts.min.js')); ?>"></script>
	<script src="<?php echo e(asset('opac/js/functions.js')); ?>"></script>

	<!-- DATATABLE SCRIPTS -->
	<!-- <script src="<?php echo e(asset('opac/DataTables/datatables.min.js')); ?>"></script> -->
	<script src="<?php echo e(asset('opac/DataTables/DataTables-1.12.1/js/jquery.dataTables.min.js')); ?>"></script>
	<script src="<?php echo e(asset('opac/DataTables/DataTables-1.12.1/js/dataTables.bootstrap5.min.js')); ?>"></script>

	<!-- CHATBOT -->
	

	<?php echo $__env->yieldContent('js'); ?>

	 
</body>
</html><?php /**PATH C:\Users\Joe\Documents\PCAARRD\elib\resources\views/opac/layout/master.blade.php ENDPATH**/ ?>