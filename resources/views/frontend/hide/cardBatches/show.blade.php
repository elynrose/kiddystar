@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.show') }} {{ trans('cruds.cardBatch.title') }}
                </div>

                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.card-batches.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        {{ trans('cruds.cardBatch.fields.id') }}
                                    </th>
                                    <td>
                                        {{ $cardBatch->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.cardBatch.fields.batch_code') }}
                                    </th>
                                    <td>
                                        {{ $cardBatch->batch_code }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.cardBatch.fields.published') }}
                                    </th>
                                    <td>
                                        {{ $cardBatch->published }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.cardBatch.fields.quantity') }}
                                    </th>
                                    <td>
                                        {{ $cardBatch->quantity }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.cardBatch.fields.distrubuted') }}
                                    </th>
                                    <td>
                                        <input type="checkbox" disabled="disabled" {{ $cardBatch->distrubuted ? 'checked' : '' }}>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        {{ trans('cruds.cardBatch.fields.business') }}
                                    </th>
                                    <td>
                                        {{ $cardBatch->business->name ?? '' }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-default" href="{{ route('frontend.card-batches.index') }}">
                                {{ trans('global.back_to_list') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection