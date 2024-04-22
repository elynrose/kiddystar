@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.completed.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.completeds.update", [$completed->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="child_id">{{ trans('cruds.completed.fields.child') }}</label>
                            <select class="form-control select2" name="child_id" id="child_id" required>
                                @foreach($children as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('child_id') ? old('child_id') : $completed->child->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                            <select class="form-control select2" name="task_id" id="task_id" required>
                                @foreach($tasks as $id => $entry)
                                    <option value="{{ $id }}" {{ (old('task_id') ? old('task_id') : $completed->task->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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

        </div>
    </div>
</div>
@endsection