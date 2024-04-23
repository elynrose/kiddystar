@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    @if($user_points && $user_claims) Balance: {{ ($user_points - $user_claims) }} @endif
                </div>
                <div class="card-body">
                    <div class="d-flex flex-row justify-content-between mb-3">
                        <a href="{{ route('frontend.add_points', ['card'=>$userCard->card->id]) }}" class="btn btn-success">Add Points</a>
                        <a href="{{ route('frontend.add_claims', ['card'=>$userCard->card->id]) }}" class="btn btn-success">Claim Points</a>
                    </div>

                    <div id="userCardDetailsAccordion">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        User Card Details
                                    </button>
                                </h2>
                            </div>

                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#userCardDetailsAccordion">
                                <div class="card-body">
                                    <div class="list-group">
                                        <li class="list-group-item">Card ID: {{ $userCard->card->code ?? 'N/A' }}</li>
                                        <li class="list-group-item">Full Name: {{ $userCard->user->first_name ?? 'N/A' }} {{ $userCard->user->last_name ?? 'N/A' }}</li>
                                        <li class="list-group-item">Email: {{ $userCard->user->email ?? 'N/A' }}</li>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h3 class="mt-5">Points</h3>
                    <div class="list-group">
                        @foreach($all_points as $key => $point)
                            <li class="list-group-item">Spent {{ $point->amount_spent ?? 'N/A' }} and earned {{ $point->points ?? 'N/A' }} point(s) {{ $point->created_at->diffForHumans() ?? '' }}</li>
                        @endforeach
                    </div>

                    <h3 class="mt-5">Claims</h3>
                    <div class="list-group">
                        @foreach($all_claims as $key => $claim)
                            <li class="list-group-item">Claimed a reward valued at {{ $claim->amount_used ?? 'N/A' }} for {{ $claim->points ?? 'N/A' }} point(s) {{ $claim->created_at->diffForHumans() ?? '' }}</li>
                        @endforeach
                    </div>

                    <div class="form-group mt-5">
                        <a class="btn btn-default" href="{{ route('frontend.user-cards.index') }}">
                            {{ trans('global.back_to_list') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
