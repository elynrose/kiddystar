@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
        <h5 class="mb-5 text-right">  @if($user_points && $user_claims) <i class="fas fa-star"></i> Card balance: {{ ($user_points - $user_claims).' Points' }} @endif </h5>

            <div class="card">
                
                <div class="card-body">
              

                    <div class="card mt-5 mb-5">
                    <div class="{{ $chart2->options['column_class'] }}">
                                    <h5 class="mt-5">{!! $chart2->options['chart_title'] !!}</h5>
                                    {!! $chart2->renderHtml() !!}
                                </div>
                    </div>
                    <div class="list-group">
                        @foreach($all_points as $key => $point)
                            <li class="list-group-item"><span class="text-muted px-1"><i class="fas fa-clock"></i> {{ $point->created_at->diffForHumans() ?? '' }}</span> Spent {{ '$'.$point->amount_spent ?? 'N/A' }} and earned {{ $point->points ?? 'N/A' }} point(s) </li>
                        @endforeach
                    </div>

                    <h5 class="mt-5 mb-3">Claims</h5>
                    <div class="list-group">
                        @foreach($all_claims as $key => $claim)
                            <li class="list-group-item"><span class="text-muted"><i class="fas fa-clock"></i> {{ $point->created_at->diffForHumans() ?? '' }}</span> Claimed a reward valued at {{ '$'.$claim->amount_used ?? 'N/A' }} for {{ $claim->points ?? 'N/A' }} point(s) </li>
                        @endforeach
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>{!! $chart2->renderJs() !!}
@endsection