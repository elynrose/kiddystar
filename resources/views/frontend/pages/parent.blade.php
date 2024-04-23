@extends('layouts.frontend')
@section('content')
<div class="content">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Existing content -->
            <div class="card shadow-sm p-3 mb-5 bg-white rounded border">
             
                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                      
                        <div class="{{ $chart2->options['column_class'] }}">
                            <h5>{!! $chart2->options['chart_title'] !!}</h5>
                            {!! $chart2->renderHtml() !!}
                        </div>
                        <div class="{{ $chart1->options['column_class'] }}">
                            <h5>{!! $chart1->options['chart_title'] !!}</h5>
                            {!! $chart1->renderHtml() !!}
                        </div>
                    </div>
                </div>
</div>

            <div class="card mt-5 shadow-sm mb-5 bg-white rounded border">
                <div class="card-header">
                    <!-- Search input -->
                    <input type="text" id="searchInput" class="form-control shadow-sm p-3 mb-3 mt-3 bg-white rounded border" placeholder="Search...">
                </div>
                <div class="card-body">
                    <div class="row" id="cardsContainer">
                        <!-- User Cards will be here -->
                        @if($userCards->isNotEmpty())
                        @foreach($userCards as $userCard)
                        <div class="col-md-4">
                            <div class="card mb-4 shadow-sm mb-5 bg-white rounded">
                           
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">{{ $userCard->children->first_name ?? '' }}  {{ $userCard->children->last_name ?? '' }}  <span class="badge badge-default badge-pill">Points: {{ App\Models\TotalPoint::points($userCard->card_id) }}</span></li>
                                </ul>
                                <div class="card-body">
                                <h6 class="card-subtitle mb-2 text-muted number">{{ $userCard->card->code ?? 'N/A' }}</h6>
                                    <a href="{{ route('frontend.add_points', ['card'=>$userCard->card->id]) }}" class="btn btn-default btn-sm"><i class="fas fa-star yellow"></i> {{ trans('global.add_stars') }}</a>
                                    <a href="{{ route('frontend.add_claims', ['card'=>$userCard->card->id]) }}" class="btn btn-default btn-sm"><i class="fas fa-gift"></i> {{ trans('global.claim_stars') }}</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @else
                       <div class="small text-muted px-1"> {{_(':/ Looks like you dont have any customers here. Order cards and begin scanning.')}}</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>{!! $chart1->renderJs() !!}{!! $chart2->renderJs() !!}
<script>
$(document).ready(function() {
    $('#searchInput').on('keyup', function() {
        var value = $(this).val().toLowerCase();
        $("#cardsContainer .card").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
</script>
@endsection
