@extends('opac.layout.master')
@section('content')

		<div class="container margin_60">
			<div class="main_title">
				<h1>Borrowed Materials</h1>
				{{-- <p>Usu habeo equidem sanctus no. Suas summo id sed, erat erant oporteat cu pri. In eum omnes molestie. Sed ad debet scaevola, ne mel.</p> --}}
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
										@if($lists->status == 'For Approval')
											<p align='right'><span class='badge bg-secondary'> Pending </span></p>
										@elseif($lists->status == 'Borrowed')
											<p align='right'>Total days borrowed : {{ $lists->total_days }} </span></p>
										@endif
									</div>
					@endforeach
					@else
					<div class="strip_list wow fadeIn">
						<div class="row">
							<div class="col-12">
								<p align='center'>
									No borrowed materials..
								</p>
							</div>
						</div>
					</div>
					@endif
					</div>
				@include('opac.side')
			</div>
				<!-- /col -->
		</div>
@endsection

@section('js')
<script>

</script>

@endsection