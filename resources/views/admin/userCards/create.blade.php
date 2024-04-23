@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.userCard.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.user-cards.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="card_id">{{ trans('cruds.userCard.fields.card') }}</label>
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
                <span class="help-block">{{ trans('cruds.userCard.fields.card_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.userCard.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userCard.fields.user_helper') }}</span>
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