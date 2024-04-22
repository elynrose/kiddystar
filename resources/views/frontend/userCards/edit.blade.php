@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.userCard.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.user-cards.update", [$userCard->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="card_id">{{ trans('cruds.userCard.fields.card') }}</label>
                            <select class="form-control select2" name="card_id" id="card_id" required>
                                @foreach($cards as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('card_id') ? old('card_id') : $userCard->card->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('card'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('card') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.userCard.fields.card_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="children_id">{{ trans('cruds.userCard.fields.children') }}</label>
                            <select class="form-control select2" name="children_id" id="children_id" required>
                                @foreach($childrens as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('children_id') ? old('children_id') : $userCard->children->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('children'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('children') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.userCard.fields.children_helper') }}</span>
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