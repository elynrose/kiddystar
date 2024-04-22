<?php

namespace App\Http\Requests;

use App\Models\Point;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePointRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('point_edit');
    }

    public function rules()
    {
        return [
            'reason' => [
                'string',
                'required',
            ],
            'points' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'card_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
