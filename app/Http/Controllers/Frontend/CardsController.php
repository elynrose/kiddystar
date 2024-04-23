<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyCardRequest;
use App\Http\Requests\StoreCardRequest;
use App\Http\Requests\UpdateCardRequest;
use App\Models\Card;
use App\Models\CardBatch;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class CardsController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('card_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cards = Card::with(['card_batch'])->where('created_by_id', Auth::user()->id)->get();

        return view('frontend.cards.index', compact('cards'));
    }

    public function create()
    {
        abort_if(Gate::denies('card_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $card_batches = CardBatch::pluck('batch_code', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.cards.create', compact('card_batches'));
    }

    public function store(StoreCardRequest $request)
    {
        $card = Card::create($request->all());

        return redirect()->route('frontend.cards.index');
    }

    public function edit(Card $card)
    {
        abort_if(Gate::denies('card_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $card_batches = CardBatch::pluck('batch_code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $card->load('card_batch');

        return view('frontend.cards.edit', compact('card', 'card_batches'));
    }

    public function update(UpdateCardRequest $request, Card $card)
    {
        $card->update($request->all());

        return redirect()->route('frontend.cards.index');
    }

    public function show(Card $card)
    {
        abort_if(Gate::denies('card_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $card->load('card_batch');

        return view('frontend.cards.show', compact('card'));
    }

    public function destroy(Card $card)
    {
        abort_if(Gate::denies('card_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $card->delete();

        return back();
    }

    public function massDestroy(MassDestroyCardRequest $request)
    {
        $cards = Card::find(request('ids'));

        foreach ($cards as $card) {
            $card->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
