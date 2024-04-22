<?php

namespace App\Http\Requests;

use App\Models\CardBatch;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCardBatchRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('card_batch_create');
    }

    public function rules()
    {
        return [
            'batch_code' => [
                'string',
                'required',
                'unique:card_batches',
            ],
            'published' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'quantity' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
