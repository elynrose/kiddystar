<?php

namespace App\Http\Requests;

use App\Models\Configuration;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreConfigurationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('configuration_create');
    }

    public function rules()
    {
        return [
            'message' => [
                'string',
                'nullable',
            ],
            'start_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'points_per_dollar' => [
                'required',
                'numeric',
            ],
        ];
    }
}
