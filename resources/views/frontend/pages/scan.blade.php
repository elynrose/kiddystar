@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
  
            <div class="card">
                <div class="card-header">
               <h3> {{ $userCard->children->first_name ?? 'N/A' }} {{ $userCard->children->last_name ?? 'N/A' }}</h3>
               <p class="text-small">{{ $userCard->children->dob ?? 'N/A' }}</p>
             </div>
                <div class="card-body">
                    <div class="d-flex flex-row justify-content-between mb-3">
                        <a href="{{ route('frontend.add_points', ['card'=>$userCard->card->id]) }}" class="btn btn-default btn-sm"><i class="fas fa-plus"></i> Add Points</a>
                        <a href="{{ route('frontend.add_claims', ['card'=>$userCard->card->id]) }}" class="btn btn-default btn-sm"><i class="fas fa-gift"></i> Claim Points</a>
                    </div>

          
                    <div class="card mt-5 mb-5">
                    @if($all_points->isNotEmpty())
                    <div class="{{ $chart2->options['column_class'] }}">
                                    <h5 class="mt-5">{!! $chart2->options['chart_title'] !!}</h5>
                                    {!! $chart2->renderHtml() !!}
                                </div>
                    </div>
                    <div class="list-group">
                        @foreach($all_points as $key => $point)
                            <li class="list-group-item"><span class="text-muted px-1"><i class="fas fa-clock"></i> {{ $point->created_at->diffForHumans() ?? '' }}</span> {{ $userCard->children->first_name ?? 'N/A' }} earned {{ $point->points ?? 'N/A' }} point(s) for task: "<em>{{$point->reason}}</em>"</li>
                        @endforeach
                    </div>
                    @else
                    @endif
                    @if($all_claims->isNotEmpty())
                    <h5 class="mt-5 mb-3">Claims</h5>
                    <div class="list-group">
                        @foreach($all_claims as $key => $claim)
                            <li class="list-group-item"><span class="text-muted"><i class="fas fa-clock"></i> {{ $point->created_at->diffForHumans() ?? '' }}</span> {{ $userCard->children->first_name ?? 'N/A' }} claimed a reward for {{ $claim->points ?? 'N/A' }} point(s) </li>
                        @endforeach
                    </div>
                    @else
                  
                    @endif
                    <div class="form-group mt-5">
                        <a class="btn btn-default" href="{{ route('frontend.home') }}">
                            {{ trans('global.back_to_list') }}
                        </a>
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