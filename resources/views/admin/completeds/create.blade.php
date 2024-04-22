@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.completed.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.completeds.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="child_id">{{ trans('cruds.completed.fields.child') }}</label>
                <select class="form-control select2 {{ $errors->has('child') ? 'is-invalid' : '' }}" name="child_id" id="child_id" required>
                    @foreach($children as $id => $entry)
                        <option value="{{ $id }}" {{ old('child_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('child'))
                    <div class="invalid-feedback">
                        {{ $errors->first('child') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.completed.fields.child_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="task_id">{{ trans('cruds.completed.fields.task') }}</label>
                <select class="form-control select2 {{ $errors->has('task') ? 'is-invalid' : '' }}" name="task_id" id="task_id" required>
                    @foreach($tasks as $id => $entry)
                        <option value="{{ $id }}" {{ old('task_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('task'))
                    <div class="invalid-feedback">
                        {{ $errors->first('task') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.completed.fields.task_helper') }}</span>
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