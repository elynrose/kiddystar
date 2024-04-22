<?php

namespace App\Http\Requests;

use App\Models\UserCard;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateUserCardRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('user_card_edit');
    }

    public function rules()
    {
        return [
            'card_id' => [
                'required',
                'integer',
            ],
            'children_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
