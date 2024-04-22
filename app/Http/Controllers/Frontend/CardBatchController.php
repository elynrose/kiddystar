<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCardBatchRequest;
use App\Http\Requests\StoreCardBatchRequest;
use App\Http\Requests\UpdateCardBatchRequest;
use App\Models\CardBatch;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CardBatchController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('card_batch_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cardBatches = CardBatch::with(['business'])->get();

        return view('frontend.cardBatches.index', compact('cardBatches'));
    }

    public function create()
    {
        abort_if(Gate::denies('card_batch_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $businesses = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.cardBatches.create', compact('businesses'));
    }

    public function store(StoreCardBatchRequest $request)
    {
        $cardBatch = CardBatch::create($request->all());

        return redirect()->route('frontend.card-batches.index');
    }

    public function edit(CardBatch $cardBatch)
    {
        abort_if(Gate::denies('card_batch_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $businesses = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cardBatch->load('business');

        return view('frontend.cardBatches.edit', compact('businesses', 'cardBatch'));
    }

    public function update(UpdateCardBatchRequest $request, CardBatch $cardBatch)
    {
        $cardBatch->update($request->all());

        return redirect()->route('frontend.card-batches.index');
    }

    public function show(CardBatch $cardBatch)
    {
        abort_if(Gate::denies('card_batch_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cardBatch->load('business');

        return view('frontend.cardBatches.show', compact('cardBatch'));
    }

    public function destroy(CardBatch $cardBatch)
    {
        abort_if(Gate::denies('card_batch_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cardBatch->delete();

        return back();
    }

    public function massDestroy(MassDestroyCardBatchRequest $request)
    {
        $cardBatches = CardBatch::find(request('ids'));

        foreach ($cardBatches as $cardBatch) {
            $cardBatch->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
