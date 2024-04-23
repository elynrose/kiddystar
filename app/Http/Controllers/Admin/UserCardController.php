<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserCardRequest;
use App\Http\Requests\StoreUserCardRequest;
use App\Http\Requests\UpdateUserCardRequest;
use App\Models\Card;
use App\Models\User;
use App\Models\UserCard;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserCardController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user_card_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userCards = UserCard::with(['card', 'user', 'created_by'])->get();

        return view('admin.userCards.index', compact('userCards'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_card_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cards = Card::pluck('code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.userCards.create', compact('cards', 'users'));
    }

    public function store(StoreUserCardRequest $request)
    {
        $userCard = UserCard::create($request->all());

        return redirect()->route('admin.user-cards.index');
    }

    public function edit(UserCard $userCard)
    {
        abort_if(Gate::denies('user_card_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cards = Card::pluck('code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $userCard->load('card', 'user', 'created_by');

        return view('admin.userCards.edit', compact('cards', 'userCard', 'users'));
    }

    public function update(UpdateUserCardRequest $request, UserCard $userCard)
    {
        $userCard->update($request->all());

        return redirect()->route('admin.user-cards.index');
    }

    public function show(UserCard $userCard)
    {
        abort_if(Gate::denies('user_card_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userCard->load('card', 'user', 'created_by');

        return view('admin.userCards.show', compact('userCard'));
    }

    public function destroy(UserCard $userCard)
    {
        abort_if(Gate::denies('user_card_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userCard->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserCardRequest $request)
    {
        $userCards = UserCard::find(request('ids'));

        foreach ($userCards as $userCard) {
            $userCard->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
