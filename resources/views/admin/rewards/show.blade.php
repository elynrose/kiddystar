@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.reward.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.rewards.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.reward.fields.id') }}
                        </th>
                        <td>
                            {{ $reward->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.reward.fields.photo') }}
                        </th>
                        <td>
                            @foreach($reward->photo as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.reward.fields.name') }}
                        </th>
                        <td>
                            {{ $reward->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.reward.fields.description') }}
                        </th>
                        <td>
                            {!! $reward->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.reward.fields.points') }}
                        </th>
                        <td>
                            {{ $reward->points }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.rewards.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection