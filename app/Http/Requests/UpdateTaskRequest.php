<?php

namespace App\Http\Requests;

use App\Models\Task;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTaskRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('task_edit');
    }

    public function rules()
    {
        return [
            'task_name' => [
                'string',
                'required',
            ],
            'points' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'assigned_tos.*' => [
                'integer',
            ],
            'assigned_tos' => [
                'required',
                'array',
            ],
            'occourance' => [
                'required',
            ],
            'complete_by' => [
                'date_format:' . config('panel.date_format'),
            ],
        ];
    }
}
