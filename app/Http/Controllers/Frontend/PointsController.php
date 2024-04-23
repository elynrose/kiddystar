<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPointRequest;
use App\Http\Requests\StorePointRequest;
use App\Http\Requests\UpdatePointRequest;
use App\Models\Card;
use App\Models\Point;
use App\Models\Configuration;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;
use App\Models\UserCard;
use Carbon\carbon as Carbon;
use Session;
use Redirect;


class PointsController extends Controller

{
    public function index()
    {
        abort_if(Gate::denies('point_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $points = Point::with(['card', 'created_by'])->where('created_by_id', Auth::user()->id)->get();

        return view('frontend.pages.points-awarded', compact('points'));
    }

    public function create(Request $request)
    {
        abort_if(Gate::denies('point_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        if($request->card && !empty($request->card)){
            $card =  $request->card;
        }
       

        return view('frontend.pages.add-points', compact('card'));
    }

    public function store(StorePointRequest $request)
    {
        $point = Point::create($request->all());
        
        $user_card= UserCard::where('card_id', $request->card_id)
        ->leftjoin('users', 'users.id', 'user_cards.children_id')->first();
        $user=$user_card->children->first_name;
        $points = $request->points;

        return view('frontend.pages.points-added', compact('points', 'user'));
    }

    public function edit(Point $point)
    {
        abort_if(Gate::denies('point_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cards = Card::pluck('code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $point->load('card', 'created_by');

        return view('frontend.points.edit', compact('cards', 'point'));
    }

    public function update(UpdatePointRequest $request, Point $point)
    {
        $point->update($request->all());

        return redirect()->route('frontend.points.index');
    }

    public function show(Point $point)
    {
        abort_if(Gate::denies('point_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $point->load('card', 'created_by');

        return view('frontend.points.show', compact('point'));
    }

    public function destroy(Point $point)
    {
        abort_if(Gate::denies('point_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $point->delete();

        return back();
    }

    public function massDestroy(MassDestroyPointRequest $request)
    {
        $points = Point::find(request('ids'));

        foreach ($points as $point) {
            $point->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
