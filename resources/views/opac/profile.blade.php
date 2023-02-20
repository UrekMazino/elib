@extends('opac.layout.master')

@section('content')

		<div class="container margin_60">
			<div class="main_title">
				<h1>Profile</h1>
				{{-- <p>Usu habeo equidem sanctus no. Suas summo id sed, erat erant oporteat cu pri. In eum omnes molestie. Sed ad debet scaevola, ne mel.</p> --}}
			</div>
			<div class="row">
				<div class="col-9">
				<div class="box_general_3 cart">
					<div class="form_title">
						<h3><strong>1</strong>Your Details</h3>
					</div>
					<div class="step">
						<div class="row">
							<div class="col-md-6 col-sm-6">
								<div class="form-group">
									<label>First name</label>
									<input type="text" class="form-control" id="firstname_booking" name="firstname_booking" placeholder="{{ Auth::user()->name }}">
								</div>
							</div>
							<div class="col-md-6 col-sm-6">
								<div class="form-group">
									<label>Contact number</label>
									<input type="text" class="form-control" id="lastname_booking" name="lastname_booking" value="{{ Auth::user()->contactnum }}">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-sm-6">
								<div class="form-group">
									<label>Email</label>
									<input type="email" id="email_booking" name="email_booking" class="form-control" value="{{ Auth::user()->email }}">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-sm-6">
								
							</div>
						</div>
					</div>
					
					<hr>

					<div class="form_title">
						<h3><strong>2</strong>Securtiy</h3>
						<p>
							Leave blank if you don't want to change password
						</p>
					</div>
					<div class="step">
						<div class="row">
							<div class="col-md-6 col-sm-6">
								<div class="form-group">
									<label>Password</label>
									<input type="password" id="password" name="password" class="form-control">
								</div>
							</div>
							<div class="col-md-6 col-sm-6">
								<div class="form-group">
									<label>Confirm Password</label>
									<input type="password" id="password2" name="password2" class="form-control">
								</div>
							</div>
						</div>
					</div>
					<hr>
					<!--End step -->
					<!--End step -->
					<div id="policy">
						<center><span><a href="#0" class="btn_1 btn-lg">Save Changes</a></span></center>
					</div>
				</div>
				</div>
				<!-- /col -->
				@include('opac.side')
			</div>
			<!-- /row -->
		</div>
@endsection

@section('js')

@endsection