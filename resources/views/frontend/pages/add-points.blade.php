@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow-sm p-3 mb-5 bg-white rounded">
                <div class="card-header">
               <h5>{{ _('Add') }} {{ trans('cruds.point.fields.points') }}</h5> 
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.points.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        
                        <div class="form-group">
                            <label for="points">{{ trans('cruds.point.fields.points') }}: <span id="points_text"></span></label>
                            <input class="form-control" type="text" name="points" id="points" value="{{ old('points', '') }}" step="0.01" required>
                            @if($errors->has('points'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('points') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.point.fields.points_helper') }}</span>
                        </div>

                        <div class="form-group">
                            <label for="reason">{{ trans('cruds.point.fields.reason') }}: </label>
                            <input class="form-control" type="text" name="reason" id="reason" value="{{ old('reason', '') }}" required>
                            @if($errors->has('reason'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('reason') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.point.fields.reason_helper') }}</span>
                        </div>


                        <div class="form-group">
                        <div class="row">
            <div class="col-md-12">
                <button class="btn" id="decrease"><i class="fas fa-minus-circle"></i></button>
                <input type="range" id="slider-range" min="1" max="100" value="50" class="slider mx-">
                <button class="btn" id="increase"><i class="fas fa-plus-circle"></i></button>
            </div>
        </div>
            </div>

                        </div>
                      
                        <div class="form-group  px-4">
                            @if(Request::segment(3) && !empty(Request::segment(3)))
                            <input type="hidden" value="{{ $card }}" name="card_id">
                            @endif
                            <input type="hidden" value="{{ Auth::user()->id }}" name="created_by_id">
                            <button class="btn btn-default" type="submit">
                            <i class="fas fa-star yellow"></i><strong> {{ trans('global.add_stars') }}</strong>
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
    var $slider = $("#slider-range");
    var $points = $("#points");

    // Update the points field when the slider value changes
    $slider.on('input change', function() {
        $points.val($(this).val());
    });

    // Increment slider value
    $('#increase').click(function(e) {
        e.preventDefault();
        var value = parseInt($slider.val());
        if (value < 100) {
            $slider.val(value + 1).trigger('input');
        }
    });

    // Decrement slider value
    $('#decrease').click(function(e) {
        e.preventDefault();
        var value = parseInt($slider.val());
        if (value > 1) {
            $slider.val(value - 1).trigger('input');
        }
    });
});
</script>
@endsection
@endsection


