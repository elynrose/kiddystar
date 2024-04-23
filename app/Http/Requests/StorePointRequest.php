<?php

namespace App\Http\Requests;

use App\Models\Point;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePointRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('point_create');
    }

    public function rules()
    {
        return [
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
            'reason' => [
                'string',
            ],
        ];
    }
}
