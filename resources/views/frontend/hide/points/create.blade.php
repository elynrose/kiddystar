@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.point.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.points.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="amount_spent">{{ trans('cruds.point.fields.amount_spent') }}</label>
                            <input class="form-control" type="number" name="amount_spent" id="amount_spent" value="{{ old('amount_spent', '') }}" step="0.01" required>
                            @if($errors->has('amount_spent'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('amount_spent') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.point.fields.amount_spent_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="points">{{ trans('cruds.point.fields.points') }}</label>
                            <input class="form-control" type="number" name="points" id="points" value="{{ old('points', '') }}" step="1" required>
                            @if($errors->has('points'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('points') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.point.fields.points_helper') }}</span>
                        </div>
                      
                        <div class="form-group">
                            @if(Request::segment(3) && !empty(Request::segment(3)))
                            <input type="hidden" value="{{ $card }}" name="card_id">
                            @endif
                            <input type="hidden" value="{{ Auth::user()->id }}" name="created_by_id">
                            <button class="btn btn-danger" type="submit">
                                {{ trans('global.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@section('scripts')
@parent
<script>
        $(document).ready(function() {
            $('#amount_spent').keyup(function() {
                var value = $(this).val();
                var numericValue = parseFloat(value);
                
                // Check if the input is a positive number and not NaN
                if (!isNaN(numericValue) && numericValue >= 0) {
                    var points = Math.ceil(numericValue / {{ $configurations->points_per_dollar }});
                    $('#points').val(points);
                } else {
                    $('#points').val('0');
                }
            });
        });
    </script>
@endsection
@endsection


