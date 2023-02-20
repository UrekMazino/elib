@extends('opac.layout.master')

@section('css')
    <!-- SPECIFIC CSS -->
    <link href="{{ asset('opac/css/date_picker.css') }}" rel="stylesheet">
 @endsection

@section('content')
<form method="get" action="{{ url('/results') }}" id="frm" target="_blank">
	@csrf
	<input type="hidden" class="form-control" name="query" value="">
	<input type="hidden" class="form-control" name="series_statement_id" value="{{ $result->series_statement_id }}">
	<input type="hidden" name="seachtype[]" value="all-material">
	<input type="hidden" class="form-control" name="page" value="1">
	<input type="hidden" class="form-control" name="layout" value="grid">
</form>
<?php
	$review = showReview($result->holdings_id);
	$review_ctr = count($review);
	$ave = starRatingAve($result->holdings_id);
?>
<form method="post" action="{{ url('/review') }}" id="frm_review">
	@csrf
	<input type="hidden" class="form-control" name="holdings_id" value="{{ $result->holdings_id }}">
</form>
		<div id="breadcrumb" style="background-color: #00a496;">
			<div class="container">
				<ul>
					<li><a href="#">Home</a></li>
					<li><a href="#">Material</a></li>
					<li>Description</li>
				</ul>
			</div>
		</div>
		<!-- /breadcrumb -->

		<div class="container margin_60">
			<div class="row">
				<div class="col-xl-8 col-lg-8">
					<nav id="secondary_nav" style="background-color: #00a496;">
						<div class="container">
							<ul class="clearfix">
								<li><a href="#section_1" class="active">General info</a></li>
								<li><a href="#section_2">Reviews</a></li>
							</ul>
						</div>
					</nav>
					<div id="section_1">
						<div class="box_general_3">
							<div class="profile">
								<div class="row">
									<div class="col-lg-5 col-md-4">
										<figure>
											{!! getFrontpage($result->holdings_id) !!}
										</figure>
									</div>
									<div class="col-lg-7 col-md-8">
										<small>{{ $result->material }}</small>
										<br><i data-star="{{ $ave }}" style="font-size:20px"></i>
										<h5>{!! $result->title_statement !!}</h5>

										<small>{!! pubYear($result->pub_year) !!}</small>

										@if(isset($result->series_description))
											<br><small>Series : <a href="#" onclick="getElementById('frm').submit()">{{ $result->series_description }}</a></small>
										@endif

										<br><br>
										<ul class="statistic">
											<li>{{ countNum('view',$result->id) }} Views</li>
											<li>{{ countNum('review',$result->id) }} Reviews</li>
											<li>{{ countNum('download',$result->id) }} Downloads</li>
										</ul>
										<ul class="statistic">
											@if(checkIfHasPDF($result->holdings_id))
											<li style="background-color: #FFF;padding: 3px;">
												<form method="post" action="{{ url('/download') }}" id="frm_download" target="_blank">
													@csrf
													<input type="hidden" name="holdings_download_id" value="{{ $result->holdings_id }}">
													<button class="btn_1" style="background-color:#029978"><i class="icon-download"></i> PDF</button>
												</form>
											</li>
											@endif
											<li style="background-color: #FFF;padding: 3px;">
													<button class="btn_1" style="background-color:#029978" onclick="inquire('{{ $result->holdings_id }}')"><i class="icon-info-3"></i> Inquire</button>
											</li>
											
										</ul>
									</div>
								</div>
							</div>
							
							<hr>
							
							<!-- /profile -->
							<div class="indent_title_in">
								<i class="pe-7s-notebook"></i>
								<h3>Summary</h3>
							</div>
							<div class="wrapper_indent">
								<?php echo $result->summary; ?>
							</div>

							<hr>

							<div class="indent_title_in">
								<i class="pe-7s-news-paper"></i>
								<h3>Other Details</h3>
							</div>
							<div class="wrapper_indent">
								<ul class="">
									<li><strong>Call Number</strong> - {{ $result->call_number }}</li>
									<li><strong>Joint Authors</strong> - {{ $result->joint_authors }}</li>
									<li><strong>General Notes</strong> - {{ $result->general_note }}</li>
									<li><strong>Subjects</strong> - </li>
									<li><strong>Item Availabity</strong> - <span class="badge bg-success">Available</span></li>
								</ul>
							</div>
						</div>
						<!-- /section_1 -->
					</div>
					<!-- /box_general -->

					<div id="section_2">
						<div class="box_general_3">
							<div class="reviews-container">
								<div class="row">
									<div class="col-lg-3">
										<div id="review_summary" style="background-color: #00a496;">
											

											<strong>{{ $ave }}</strong>
											<div class="rating">
												<i data-star="{{ $ave }}"></i>
											</div>
											@if($review_ctr > 0)
											<small>
												Based on {{ $review_ctr }} reviews
											</small>
											@endif
										</div>
									</div>
									<div class="col-lg-9">
										<div class="row">
											<div class="col-lg-10 col-9">
												<div class="progress">
													<div class="progress-bar" role="progressbar" style="width: {{ starRatingBar($review_ctr,5,$result->holdings_id) }}%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</div>
											<div class="col-lg-2 col-3"><small><strong>5 stars</strong></small></div>
										</div>
										<!-- /row -->
										<div class="row">
											<div class="col-lg-10 col-9">
												<div class="progress">
													<div class="progress-bar" role="progressbar" style="width: {{ starRatingBar($review_ctr,4,$result->holdings_id) }}%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</div>
											<div class="col-lg-2 col-3"><small><strong>4 stars</strong></small></div>
										</div>
										<!-- /row -->
										<div class="row">
											<div class="col-lg-10 col-9">
												<div class="progress">
													<div class="progress-bar" role="progressbar" style="width: {{ starRatingBar($review_ctr,3,$result->holdings_id) }}%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</div>
											<div class="col-lg-2 col-3"><small><strong>3 stars</strong></small></div>
										</div>
										<!-- /row -->
										<div class="row">
											<div class="col-lg-10 col-9">
												<div class="progress">
													<div class="progress-bar" role="progressbar" style="width: {{ starRatingBar($review_ctr,2,$result->holdings_id) }}%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</div>
											<div class="col-lg-2 col-3"><small><strong>2 stars</strong></small></div>
										</div>
										<!-- /row -->
										<div class="row">
											<div class="col-lg-10 col-9">
												<div class="progress">
													<div class="progress-bar" role="progressbar" style="width: {{ starRatingBar($review_ctr,1,$result->holdings_id) }}" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</div>
											<div class="col-lg-2 col-3"><small><strong>1 stars</strong></small></div>
										</div>
										<!-- /row -->
									</div>
								</div>
								<!-- /row -->

								<hr>

								@foreach($review AS $reviews)
									<div class="row">
										<div class="rev-content">
											<i data-star="{{ $reviews->rating }}"></i>
											<div class="rev-info">
												{!! $reviews->name.'&nbsp&nbsp&nbsp'.date('M d, Y',strtotime($reviews->created_at)) !!}
											</div>
											<div class="rev-text">
												<p>
													{{ $reviews->remarks }}
												</p>
											</div>
										</div>
									</div>
									<br/>
								<!-- End review-box -->
								@endforeach
							</div>
							<!-- End review-container -->
							<hr>
							<div class="text-end"><a href="#" class="btn_1" onclick="getElementById('frm_review').submit()">Submit review</a></div>
						</div>
					</div>
					<!-- /section_2 -->
				</div>
				<!-- /col -->
				<aside class="col-xl-4 col-lg-4" id="sidebar">
					<div class="box_general_3 booking">
							<div class="title" style="background-color: #00a496;">
							<h3>Schedule a Visit</h3>
							<small>Monday to Friday 08:00am-05:00pm</small>
							</div>
							@auth
								<form method="post" action="{{ url('/visit/patron') }}" id="frm_review">
								@csrf
							@else
								<form method="post" action="{{ url('/visit/guest') }}" id="frm_review">
								@csrf
								<div class="row">
									<div class="col-12">
										<div class="form-group">
											<input class="form-control" name="visit_fullname" type="text" data-lang="en" placeholder="Fullname" required>
										</div>
									</div>
									<div class="col-12">
										<div class="form-group">
											<input class="form-control" name="visit_contactnum" type="text" placeholder="Contact number">
										</div>
									</div>
									<div class="col-12">
										<div class="form-group">
											<input class="form-control" name="visit_email" type="email" placeholder="Email" required>
										</div>
									</div>
								</div>
							@endauth

							<div class="row">
								<div class="col-6">
									<div class="form-group">
										<input class="form-control" name="visit_scheddate" type="text" id="booking_date" data-lang="en" data-min-year="2020" data-max-year="2024" data-disabled-days="10/17/2017,11/18/2017" required>
									</div>
								</div>
								<div class="col-6">
									<div class="form-group">
										<input class="form-control" type="text" name="visit_schedtime" id="booking_time" value="9:00 am">
									</div>
								</div>
							</div>
							<hr>

							<div class="row">
								<div class="col-12">
									<div class="form-group">
										Physical copy of this material is available at
										<br>
										<br>	
										<select class="form-control" name="visit_location" required>
											<option value="0" disabled selected>---Select Location---</option>
											<option value="PCAARRD - Los Banos">PCAARRD - Los Banos</option>
											<option value="STII - Bicutan">STII - Bicutan</option>
										</select>
									</div>
								</div>
							</div>


							<!-- /row -->
							<ul class="treatments clearfix">
								<li>
									<div class="checkbox">
										<input type="checkbox" class="css-checkbox" id="visit1" name="visit_site" value="1">
										<label for="visit1" class="css-label">Site Visit</label>
									</div>
								</li>
								<li>
									<div class="checkbox">
										<input type="checkbox" class="css-checkbox" id="visit2" name="visit_getcopy" value="{{ $result->holdings_id }}">
										<label for="visit2" class="css-label">Borrow a physical copy</label>
									</div>
								</li>
							</ul>
							<hr>
							<button type="submit" class="btn_1 full-width">Submit</button>
							</form>
					</div>
					<!-- /box_general -->
				</aside>
				<!-- /asdide -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->



@endsection

@section('js')
<script type="text/javascript">
function inquire(holdingsid)
{
	$("#holdings_id_inquiry").val(holdingsid);
	$("#inquireModal").modal('toggle')
}
</script>
@endsection