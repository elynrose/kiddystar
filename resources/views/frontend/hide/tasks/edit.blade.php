@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.task.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.tasks.update", [$task->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="task_name">{{ trans('cruds.task.fields.task_name') }}</label>
                            <input class="form-control" type="text" name="task_name" id="task_name" value="{{ old('task_name', $task->task_name) }}" required>
                            @if($errors->has('task_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('task_name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.task.fields.task_name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="points">{{ trans('cruds.task.fields.points') }}</label>
                            <input class="form-control" type="number" name="points" id="points" value="{{ old('points', $task->points) }}" step="1" required>
                            @if($errors->has('points'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('points') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.task.fields.points_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="assigned_tos">{{ trans('cruds.task.fields.assigned_to') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="assigned_tos[]" id="assigned_tos" multiple required>
                                @foreach($assigned_tos as $id => $assigned_to)
                                    <option value="{{ $id }}" {{ (in_array($id, old('assigned_tos', [])) || $task->assigned_tos->contains($id)) ? 'selected' : '' }}>{{ $assigned_to }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('assigned_tos'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('assigned_tos') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.task.fields.assigned_to_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required">{{ trans('cruds.task.fields.occourance') }}</label>
                            <select class="form-control" name="occourance" id="occourance" required>
                                <option value disabled {{ old('occourance', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Task::OCCOURANCE_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('occourance', $task->occourance) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('occourance'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('occourance') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.task.fields.occourance_helper') }}</span>
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