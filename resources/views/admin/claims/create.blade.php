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
                <label class="required" for="amount_used">{{ trans('cruds.claim.fields.amount_used') }}</label>
                <input class="form-control {{ $errors->has('amount_used') ? 'is-invalid' : '' }}" type="number" name="amount_used" id="amount_used" value="{{ old('amount_used', '') }}" step="0.01" required>
                @if($errors->has('amount_used'))
                    <div class="invalid-feedback">
                        {{ $errors->first('amount_used') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.claim.fields.amount_used_helper') }}</span>
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