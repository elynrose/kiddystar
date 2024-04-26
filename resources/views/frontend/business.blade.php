@extends('layouts.frontend')
@section('content')
<div class="content">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <!-- Existing content -->
            <div class="card">
                <div class="card-header">
                    Dashboard
                </div>
                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="{{ $chart1->options['column_class'] }}">
                            <h3>{!! $chart1->options['chart_title'] !!}</h3>
                            {!! $chart1->renderHtml() !!}
                        </div>
                        <div class="{{ $chart2->options['column_class'] }}">
                            <h3>{!! $chart2->options['chart_title'] !!}</h3>
                            {!! $chart2->renderHtml() !!}
                        </div>
                    </div>
                </div>
</div>

            <div class="card mt-5">
                <div class="card-header">
                   <h5 class="mb-5"> {{ trans('cruds.userCard.title_singular') }} {{ trans('global.list') }}</h5>
                    <!-- Search input -->
                    <input type="text" id="searchInput" class="form-control" placeholder="Search...">
                </div>
                <div class="card-body">
                    <div class="row" id="cardsContainer">
                        <!-- User Cards will be here -->
                        @foreach($userCards as $userCard)
                        <div class="col-md-12">
                            <div class="card mb-4">
                                <div class="card-header">
                                    {{ $userCard->card->code ?? '' }}
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">First Name: {{ $userCard->children->first_name ?? '' }}</li>
                                    <li class="list-group-item">Last Name: {{ $userCard->children->last_name ?? '' }}</li>
                                    <li class="list-group-item">Points: {{ App\Models\Point::where('card_id', $userCard->card->id)->sum('points') }}</li>
                                    <li class="list-group-item">Claims: {{ App\Models\Claim::where('card_id', $userCard->card->id)->sum('points') }}</li>
                                    <li class="list-group-item">Balance: {{ App\Models\Point::where('card_id', $userCard->card->id)->sum('points') - App\Models\Claim::where('card_id', $userCard->card->id)->sum('points') }}</li>
                                </ul>
                                <div class="card-body">
                                    <a href="{{ route('frontend.add_points', ['card'=>$userCard->card->id]) }}" class="btn btn-success btn-sm">Add Stars</a>
                                    <a href="{{ route('frontend.add_claims', ['card'=>$userCard->card->id]) }}" class="btn btn-info btn-sm">Claim stars</a>
                                </div>
                            </div>
                        </div>
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
