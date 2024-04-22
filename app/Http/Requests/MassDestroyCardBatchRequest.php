<?php

namespace App\Http\Requests;

use App\Models\CardBatch;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCardBatchRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('card_batch_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:card_batches,id',
        ];
    }
}
