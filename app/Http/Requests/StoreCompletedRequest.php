<?php

namespace App\Http\Requests;

use App\Models\Completed;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCompletedRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('completed_create');
    }

    public function rules()
    {
        return [
            'child_id' => [
                'required',
                'integer',
            ],
            'task_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
