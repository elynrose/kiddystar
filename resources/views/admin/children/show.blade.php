@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.child.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.children.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.child.fields.id') }}
                        </th>
                        <td>
                            {{ $child->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.child.fields.photo') }}
                        </th>
                        <td>
                            @if($child->photo)
                                <a href="{{ $child->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $child->photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.child.fields.first_name') }}
                        </th>
                        <td>
                            {{ $child->first_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.child.fields.last_name') }}
                        </th>
                        <td>
                            {{ $child->last_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.child.fields.dob') }}
                        </th>
                        <td>
                            {{ $child->dob }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.children.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection