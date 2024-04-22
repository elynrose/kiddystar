@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.claim.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.claims.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="points">{{ trans('cruds.claim.fields.points') }}</label>
                <input class="form-control {{ $errors->has('points') ? 'is-invalid' : '' }}" type="number" name="points" id="points" value="{{ old('points', '') }}" step="1" required>
                @if($errors->has('points'))
                    <div class="invalid-feedback">
                        {{ $errors->first('points') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.claim.fields.points_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="reward_id">{{ trans('cruds.claim.fields.reward') }}</label>
                <select class="form-control select2 {{ $errors->has('reward') ? 'is-invalid' : '' }}" name="reward_id" id="reward_id">
                    @foreach($rewards as $id => $entry)
                        <option value="{{ $id }}" {{ old('reward_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                <select class="form-control select2 {{ $errors->has('card') ? 'is-invalid' : '' }}" name="card_id" id="card_id" required>
                    @foreach($cards as $id => $entry)
                        <option value="{{ $id }}" {{ old('card_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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



@endsection