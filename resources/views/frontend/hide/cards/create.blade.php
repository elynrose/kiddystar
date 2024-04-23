@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.card.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.cards.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="code">{{ trans('cruds.card.fields.code') }}</label>
                            <input class="form-control" type="text" name="code" id="code" value="{{ old('code', '') }}" required>
                            @if($errors->has('code'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('code') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.card.fields.code_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="card_batch_id">{{ trans('cruds.card.fields.card_batch') }}</label>
                            <select class="form-control select2" name="card_batch_id" id="card_batch_id" required>
                                @foreach($card_batches as $id => $entry)
                                    <option value="{{ $id }}" {{ old('card_batch_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('card_batch'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('card_batch') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.card.fields.card_batch_helper') }}</span>
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