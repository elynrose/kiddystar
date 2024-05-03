@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                <h5>{{$name}}</h5>
                </div>

                <div class="card-body">
                  <p><i class="fas fa-star"></i> This card has {{$total_points_earned}} points.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection