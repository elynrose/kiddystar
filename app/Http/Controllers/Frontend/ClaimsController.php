<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyClaimRequest;
use App\Http\Requests\StoreClaimRequest;
use App\Http\Requests\UpdateClaimRequest;
use App\Models\Card;
use App\Models\Claim;
use App\Models\Reward;
use App\Models\Point;
use App\Models\Configuration;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;
use Carbon\carbon as Carbon;
use Session;
use Redirect;



class ClaimsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('claim_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $claims = Claim::with(['card', 'created_by'])->where('created_by_id', Auth::user()->id)->get();
        return view('frontend.claims.index', compact('claims'));
    }

    public function create(Request $request)
    {
        abort_if(Gate::denies('claim_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $rewards = Reward::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        if($request->card && !empty($request->card)){
            $card =  $request->card;
        }
        
        $point = Point::where('card_id', $card)->where('created_by_id', Auth::user()->id)->first();

        //Created by id doesnt exist in db
        $rewards = Reward::with(['created_by', 'media'])->where('created_by_id', Auth::user()->id)->paginate(15);

        return view('frontend.pages.rewards', compact('card', 'rewards' ,'point'));
    }

    public function store(StoreClaimRequest $request)
    {

             //Check users total points
             $points = Point::where('card_id', $request->card_id)->sum('points');

             // If user points are not enough
             if($points < $request->points)
                {
                    Session::flash('message', "Insufficient points available to claim this reward, select something else.");
                    return Redirect::back();
                } else {
                    $claim = Claim::create($request->all());
                    return redirect()->route('frontend.claims.index');
                }
             

    }

    public function edit(Claim $claim)
    {
        abort_if(Gate::denies('claim_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $rewards = Reward::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cards = Card::pluck('code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $claim->load('card', 'created_by');

        return view('frontend.claims.edit', compact('cards', 'claim', 'rewards'));
    }

    public function update(UpdateClaimRequest $request, Claim $claim)
    {
        $claim->update($request->all());

        return redirect()->route('frontend.claims.index');
    }

    public function show(Claim $claim)
    {
        abort_if(Gate::denies('claim_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $claim->load('card', 'created_by');

        return view('frontend.claims.show', compact('claim'));
    }

    public function destroy(Claim $claim)
    {
        abort_if(Gate::denies('claim_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $claim->delete();

        return back();
    }

    public function massDestroy(MassDestroyClaimRequest $request)
    {
        $claims = Claim::find(request('ids'));

        foreach ($claims as $claim) {
            $claim->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
