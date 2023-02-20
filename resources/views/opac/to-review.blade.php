@extends('opac.layout.master')
@section('content')

		<div class="container margin_60">
			<div class="main_title">
				<h1>Reviews</h1>
			</div>
			<div class="row">
				<div class="col-9">
				@if($flag)
				@foreach($list AS $lists)
								<div class="strip_list wow fadeIn">
									<figure>
											{!! getFrontpage($lists->holdings_id) !!}
									</figure>
									<h3>{!! formatTitle($lists->title_statement) !!}</h3>
									<span class="text-muted">{{ $lists->joint_authors }}</span><br>

									{!! pubYear($lists->pub_year) !!}
									
									@if($lists->edition != '' && $lists->edition != null)
										<b>Edition : </b> {{ formatText($lists->edition) }}<br/>
									@endif
									
									<div class="rating">
										<i data-star="{{ $ave = starRatingAve($lists->id) }}"></i>
									</div>
									<p align='right'><button class="btn_1" onclick="toReview({{ $lists->id }},'{{ $lists->holdings_id }}')">Review</button></p>
								</div>
				@endforeach
				@else
				<div class="strip_list wow fadeIn">
					<div class="row">
						<div class="col-12">
							<p align='center'>
								No materials for review..
							</p>
						</div>
					</div>
				</div>
				@endif
				</div>
				@include('opac.side')
			</div>
			{{ $list->links('vendor.pagination.default') }}
				<!-- /col -->
		</div>
<form method="post" action="{{ url('/review') }}" id="frm_review">
	@csrf
	<input type="hidden" class="form-control" name="holdings_id" id="holdings_id" value="">
	<input type="hidden" class="form-control" name="download_id" id="download_id" value="">
</form>
@endsection

@section('js')
<script type="text/javascript">

function  toReview(id,holdings_id) {
	$("#holdings_id").val(holdings_id);
	$("#download_id").val(id);
	$("#frm_review").submit();
}
</script>

@endsection