<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserCardRequest;
use App\Http\Requests\StoreUserCardRequest;
use App\Http\Requests\UpdateUserCardRequest;
use App\Models\Card;
use App\Models\Point;
use App\Models\User;
use App\Models\UserCard;
use App\Models\Claim;
use App\Models\Children;
use App\Models\Completed;
use App\Models\Task;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class UserCardController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user_card_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userCards = UserCard::with(['card', 'children', 'created_by'])->where('created_by_id', Auth::user()->id)->get();

        return view('frontend.pages.customers', compact('userCards'));
    }

    public function create(Request $request)
    {
        abort_if(Gate::denies('user_card_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        //Check and validate request segment
        if($request->segment(3) && !empty($request->segment(3))){
           $card_code = $request->segment(3);
        }
        //Get the card id based on the card code
        $cards = Card::where('code', $card_code)->first();
        $card_id = $cards->id;
        $created_by_id = Auth::user()->id;

        return view('frontend.userCards.add', compact('card_id', 'created_by_id'));
    }

    public function store(StoreUserCardRequest $request)
    {
        $userCard = UserCard::create($request->all());

        return redirect()->route('frontend.user-cards.index');
    }

    public function edit(UserCard $userCard)
    {
        abort_if(Gate::denies('user_card_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cards = Card::pluck('code', 'id')->prepend(trans('global.pleaseSelect'), '');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $userCard->load('card', 'user', 'created_by');

        return view('frontend.userCards.edit', compact('cards', 'userCard', 'users'));
    }

    public function update(UpdateUserCardRequest $request, UserCard $userCard)
    {
        $userCard->update($request->all());

        return redirect()->route('frontend.user-cards.index');
    }

    public function show(UserCard $userCard)
    {
        abort_if(Gate::denies('user_card_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userCard->load('card', 'user',  'created_by');

        $user_points =  Point::where('card_id', '=', $userCard->card_id)->where('created_by_id', Auth::user()->id)->sum('points');
        $all_points =  Point::where('card_id', '=', $userCard->card_id)->where('created_by_id', Auth::user()->id)->get();
        
      

        return view('frontend.userCards.show', compact('userCard', 'user_points',  'all_points', 'all_claims', 'user_claims'));

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


    public function addPoints(Request $request)
    {
        $data = $request->validate([
            'task' => 'required|integer',
            'child' => 'required|integer',
        ]);

        try {

        $task = Task::where('id', $data['task'])->first();
        $card = UserCard::where('children_id', $data['child'])->first();

        //Add points to user
        $user_points = [
            'points'=>$task->points,
            'reason'=>$task->task_name,
            'card_id'=>$card->card_id,
            'created_by_id'=>Auth::user()->id,
        ];

        $create_points = Point::create( $user_points );

        if($create_points){
            Completed::create(
                [
                    'child_id'=>$data['child'],
                    'task_id'=>$data['task'],
                    'created_by_id'=>Auth::user()->id,
                ]
            );
        }

        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Record not found'], 404);
        }
       

    }


}
