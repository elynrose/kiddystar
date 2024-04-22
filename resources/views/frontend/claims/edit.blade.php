@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.claim.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.claims.update", [$claim->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="points">{{ trans('cruds.claim.fields.points') }}</label>
                            <input class="form-control" type="number" name="points" id="points" value="{{ old('points', $claim->points) }}" step="1" required>
                            @if($errors->has('points'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('points') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.claim.fields.points_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="reward_id">{{ trans('cruds.claim.fields.reward') }}</label>
                            <select class="form-control select2" name="reward_id" id="reward_id">
                                @foreach($rewards as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('reward_id') ? old('reward_id') : $claim->reward->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('reward'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('reward') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.claim.fields.reward_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="card_id">{{ trans('cruds.claim.fields.card') }}</label>
                            <select class="form-control select2" name="card_id" id="card_id" required>
                                @foreach($cards as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('card_id') ? old('card_id') : $claim->card->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('card'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('card') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.claim.fields.card_helper') }}</span>
                        </div>
                        <div class="form-group">
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
@endsection