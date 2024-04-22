@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.cardBatch.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.card-batches.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="batch_code">{{ trans('cruds.cardBatch.fields.batch_code') }}</label>
                <input class="form-control {{ $errors->has('batch_code') ? 'is-invalid' : '' }}" type="text" name="batch_code" id="batch_code" value="{{ old('batch_code', '') }}" required>
                @if($errors->has('batch_code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('batch_code') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cardBatch.fields.batch_code_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="published">{{ trans('cruds.cardBatch.fields.published') }}</label>
                <input class="form-control date {{ $errors->has('published') ? 'is-invalid' : '' }}" type="text" name="published" id="published" value="{{ old('published') }}">
                @if($errors->has('published'))
                    <div class="invalid-feedback">
                        {{ $errors->first('published') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cardBatch.fields.published_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="quantity">{{ trans('cruds.cardBatch.fields.quantity') }}</label>
                <input class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}" type="number" name="quantity" id="quantity" value="{{ old('quantity', '') }}" step="1">
                @if($errors->has('quantity'))
                    <div class="invalid-feedback">
                        {{ $errors->first('quantity') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cardBatch.fields.quantity_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('distrubuted') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="distrubuted" value="0">
                    <input class="form-check-input" type="checkbox" name="distrubuted" id="distrubuted" value="1" {{ old('distrubuted', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="distrubuted">{{ trans('cruds.cardBatch.fields.distrubuted') }}</label>
                </div>
                @if($errors->has('distrubuted'))
                    <div class="invalid-feedback">
                        {{ $errors->first('distrubuted') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cardBatch.fields.distrubuted_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="business_id">{{ trans('cruds.cardBatch.fields.business') }}</label>
                <select class="form-control select2 {{ $errors->has('business') ? 'is-invalid' : '' }}" name="business_id" id="business_id">
                    @foreach($businesses as $id => $entry)
                        <option value="{{ $id }}" {{ old('business_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('business'))
                    <div class="invalid-feedback">
                        {{ $errors->first('business') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.cardBatch.fields.business_helper') }}</span>
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