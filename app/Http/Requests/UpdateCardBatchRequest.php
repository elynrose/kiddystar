<?php

namespace App\Http\Requests;

use App\Models\CardBatch;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCardBatchRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('card_batch_edit');
    }

    public function rules()
    {
        return [
            'batch_code' => [
                'string',
                'required',
                'unique:card_batches,batch_code,' . request()->route('card_batch')->id,
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
