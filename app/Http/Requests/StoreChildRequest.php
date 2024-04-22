<?php

namespace App\Http\Requests;

use App\Models\Child;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreChildRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('child_create');
    }

    public function rules()
    {
        return [
            'unique' => [
                'string',
                'required',
                'unique:children',
            ],
            'first_name' => [
                'string',
                'required',
            ],
            'last_name' => [
                'string',
                'required',
            ],
            'dob' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
        ];
    }
}
