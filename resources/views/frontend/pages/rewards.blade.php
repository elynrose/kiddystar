@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
    <h5>Claim your reward</h5>
    <p class="mb-5">You have <span class="number">
        @if($point)
        {{ App\Models\TotalPoint::points($point->card_id) }}
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
                        <p class="card-text small"><strong>Category:</strong> {{ $reward->category ?? 'N/A' }}<br>
                           <strong> Points Required:</strong> {{ $reward->points ?? 'N/A' }}</p>
                        <form method="POST" action="{{ route('frontend.claims.store') }}" enctype="multipart/form-data" class="mt-auto">
                            @csrf
                            @if(Request::segment(3) && !empty(Request::segment(3)))
                            <input type="hidden" value="{{ Request::segment(3) }}" name="card_id">
                            @endif
                            <input type="hidden" value="{{ Auth::user()->id }}" name="created_by_id">
                            <input type="hidden" name="points" class="points" value="{{ $reward->points ?? '' }}">
                            <button class="btn btn-default btn-sm" type="submit">
                              <i class="fas fa-gift"></i>  Claim Reward
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    </div>
    {{ $rewards->links() }}
</div>
</div>
@endsection

@section('scripts')
@parent

@endsection
