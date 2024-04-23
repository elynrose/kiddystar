@extends('layouts.frontend')
@section('content')
<div class="container">
    <h1>Claim your reward</h1>
    <p class="mb-5">You have <span class="badge badge-danger">
        @if($points && $claims)
        Balance: {{ ($points - $claims) }}
        @else
        {{ '0' }}
        @endif
    </span> points available.</p>
    <div class="row">
        @foreach($rewards as $reward)
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    <div class="card-body d-flex flex-column">
                        
                        @foreach($reward->photo as $media)
                           
                                <img src="{{ $media->getUrl() }}" class="card-img-top mb-2" alt="Reward Image">
                           
                        @endforeach
                        <h5 class="card-title">{{ $reward->name }}</h5>
                        <p class="card-text">Qty: {{ $reward->quantity ?? 'N/A' }}<br>
                            Price: ${{ $reward->price ?? 'N/A' }}<br>
                            Points Required: {{ $reward->points ?? 'N/A' }}</p>
                        <form method="POST" action="{{ route('frontend.claims.store') }}" enctype="multipart/form-data" class="mt-auto">
                            @csrf
                            @if(Request::segment(3) && !empty(Request::segment(3)))
                            <input type="hidden" value="{{ Request::segment(3) }}" name="card_id">
                            @endif
                            <input type="hidden" value="{{ $reward->id }}" name="reward_id">
                            <input type="hidden" value="{{ Auth::user()->id }}" name="created_by_id">
                            <input type="hidden" name="points" class="points" value="{{ $reward->points ?? '' }}">
                            <input type="hidden" name="amount_used" class="amount_used" value="{{ $reward->price ?? '' }}">
                            <button class="btn btn-info" type="submit">
                                Claim Reward
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

@section('scripts')
@parent
<script>
$(document).ready(function() {
    $('#amount_spent').keyup(function() {
        var value = $(this).val();
        var numericValue = parseFloat(value);
        
        // Check if the input is a positive number and not NaN
        if (!isNaN(numericValue) && numericValue >= 0) {
            var points = Math.ceil(numericValue / {{ $configurations->points_per_dollar ?? 1 }});
            $('#points').val(points);
        } else {
            $('#points').val('0');
        }
    });
});
</script>
@endsection
