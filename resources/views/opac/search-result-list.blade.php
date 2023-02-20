@extends('opac.layout.master')

@section('css')
    <!-- SPECIFIC CSS -->
    <link href="{{ asset('opac/css/date_picker.css') }}" rel="stylesheet">
 @endsection

@section('content')
   <div id="results" style="background-color: #00a496;">
       <div class="container">
           <div class="row">
               <div class="col-md-6">
                   <!-- <h4><strong>Showing 10</strong> of {{ $result->total() }} results</h4> -->
               </div>
               <div class="col-md-6">
               	<form method="get" action="{{ url('/results') }}" id="frm">
					@csrf
                    <div class="search_bar_list">
                    	<input type="text" class="form-control" name="query" placeholder="Search a Material...">
						@if(isset($_GET['query']))
	                    <input type="hidden" name="query" value="{{ $_GET['query'] }}">
						@endif
	                    <input type="hidden" name="series_statement_id" value="{{ $_GET['series_statement_id'] }}">
	                    <input type="hidden" name="page" value="{{ $_GET['page'] }}">
	                    <input type="hidden" name="layout" id="layout" value="{{ $_GET['layout'] }}">
	                    <input type="submit" value="Search">
                	</div>
               </div>
           </div>
           <!-- /row -->
       </div>
       <!-- /container -->
   </div>
   <!-- /results -->
   
   <div class="filters_listing">
		<div class="container">
			<ul class="clearfix">
				<li>
					{{-- <h6>Type</h6>
					<div class="form-check form-check-inline">
							<input class="form-check-input" type="checkbox" value="all-material" id="checkAll" name="seachtype[]" checked>
	  						<label class="form-check-label" for="checkAll" style="padding: 2px!important;background-color: transparent;">
	    								All
	  						</label>
  						</div>
  						@foreach(getMaterials() AS $materials)
  						<div class="form-check form-check-inline">
							<input class="form-check-input" type="checkbox" value="{{ $materials->id }}" name="seachtype[]" id="materials-{{ $materials->id }}">
	  						<label class="form-check-label lbl-check" id="materials-{{ $materials->id }}" style="padding: 2px!important;background-color: transparent;" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $materials->tooltip }}">
	    								{{ $materials->name }}
	  						</label>
  						</div>
  						@endforeach --}}
  						</form>
				</li>
				<li>
						<h6>Layout</h6>
						<div class="layout_view">
							<a href="#0" tooltip="List View"  data-bs-toggle="tooltip" data-bs-placement="top" title="Grid View"><i class="icon-th" onclick="changeLayout('grid')"></i></a>
							<a href="#0" class="active" ><i class="icon-th-list"></i></a>
						</div>
					</li>
			</ul>
		</div>
		<!-- /container -->
	</div>
	<!-- /filters -->
	   
	<div class="container margin_60_35">
		<div class="row">
			<div class="col-lg-9">
				@if(isset($_GET['query']) && $_GET['query'] != '')
				<h3 class="alert alert-info">Results for "{{ $_GET['query'] }}"</h3>
				@else
					@if($_GET['series_statement_id'] != 0)
						<h3 class="alert alert-info">Results for series : "{{ getSeriesDesc($_GET['series_statement_id']) }}"</h3>
					@endif
				@endif
				<div class="row">
					@foreach($result AS $results)
					<div class="col-md-12">
						<div class="strip_list wow fadeIn">
							<figure>
								{!! getFrontpage($results->holdings_id) !!}
							</figure>
							<small>{{ $results->material }}</small>
							<h5>{{ maxTitle($results->title_statement,200)  }}</h5>
							<span class="text-muted">{{ $results->joint_authors }}</span><br>

							{!! pubYear($results->pub_year) !!}
							
							@if($results->edition != '' && $results->edition != null)
									<b>Edition : </b> {{ formatText($results->edition) }}<br/>
								@endif
							<div class="rating">
									<i data-star="{{ $ave = starRatingAve($results->holdings_id) }}"></i>
							</div>
							<br/>
							<p align="right"><a href="#0" class="btn_1" onclick="submitFrm('{{ $results->holdings_id }}')">Full description</a></p>
						</div>
					</div>

					@endforeach
					<!-- /box_list -->

					
				</div>
				<!-- /row -->


				{{ $result->appends(['series_statement_id' => $_GET['series_statement_id'],'layout' => $_GET['layout']])->links('vendor.pagination.default') }}

				<!-- /pagination -->
			</div>

			<aside class="col-xl-3 col-lg-3" id="sidebar">
				<div class="box_general_3 booking">
						<div class="title" style="background-color: #00a496;">
						<h3>Filter Result</h3>
						</div>
						<ul class="treatments clearfix">
							@foreach(getMaterials() AS $materials)
								<li>
									<div class="checkbox">
										<input type="checkbox" class="css-checkbox" id="mat_{{$materials->id}}" name="visit_site" value="{{ $materials->id }}">
										<label for="mat_{{$materials->id}}" class="css-label">{{ $materials->name }}</label>
									</div>
								</li>
							@endforeach
							</ul>
						
				</div>
			</aside>
			<!-- /col -->
			
		</div>
		<!-- /row -->
	</div>
<form method="post" action="{{ url('/full-description') }}" id="frm2" target="_blank">
	@csrf
	<input type="hidden" name="holding_id" id="holding_id">
</form>
@endsection

@section('js')
	<!-- SPECIFIC SCRIPTS -->
	<script src="{{ asset('opac/js/markerclusterer.js') }}"></script>
    <script src="{{ asset('opac/js/map_listing.js') }}"></script>
    <script src="{{ asset('opac/js/infobox.js') }}"></script>
    <script type="text/javascript">
	
	$("#checkAll").click(function () {
        $('.form-check-input').not(this).prop('checked', false);
      });

	$(".form-check-input").click(function () {
        $('#checkAll').not(this).prop('checked', false);
      });

	function submitFrm(id)
	{
		$("#holding_id").val(id)
		$("#frm2").submit();
	}

	function changeLayout(layout)
	{
		$("#layout").val(layout);
		$("#frm").submit();
	}
</script>
@endsection