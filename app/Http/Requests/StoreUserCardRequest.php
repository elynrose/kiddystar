<?php

namespace App\Http\Requests;

use App\Models\UserCard;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreUserCardRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('user_card_create');
    }

    public function rules()
    {
        return [
            'card_id' => [
                'required',
                'integer',
            ],
            'user_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
