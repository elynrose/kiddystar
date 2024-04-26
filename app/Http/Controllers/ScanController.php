<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Card;
use App\Models\UserCard;
use App\Models\Point;
use App\Models\Claim;
use Auth;
use LaravelDaily\LaravelCharts\Classes\LaravelFrontChart;


class ScanController extends Controller
{
    /**
     * Apply authentication middleware to the controller.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Handle the display of scanned card information.
     *
     * @param Request $request The HTTP request object.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View View response with card information or error message.
     */
    public function index(Request $request)
    {
        // Attempt to find the card based on the provided card code.
        $card = $this->cardExist($request->card);
        
        if ($card) {
            // Check if the card is already registered to a user.
            $userCard = UserCard::where('card_id', $card->id)->first();

            if ($userCard) {

                if(Auth::check()) {

                    
                $settings2 = [
                    'chart_title'           => 'Points',
                    'chart_type'            => 'line',
                    'report_type'           => 'group_by_date',
                    'model'                 => 'App\Models\Point',
                    'group_by_field'        => 'created_at',
                    'group_by_period'       => 'day',
                    'aggregate_function'    => 'sum',
                    'aggregate_field'       => 'points',
                    'filter_field'          => 'created_at',
                    'filter_days'           => '30',
                    'group_by_field_format' => 'Y-m-d H:i:s',
                    'column_class'          => 'col-md-12',
                    'entries_number'        => '5',
                    'translation_key'       => 'point',
                    'card_id'       => $userCard->card_id,
                ];
        
                $chart2 = new LaravelFrontChart($settings2);


                // Fetch the points and claims associated with the card.
                $user_points = Point::where('card_id', $userCard->card_id)
                                    ->where('created_by_id', Auth::user()->id)
                                    ->sum('points');
                $all_points = Point::where('card_id', $userCard->card_id)
                                   ->where('created_by_id', Auth::user()->id)
                                   ->get();
                $user_claims = Claim::where('card_id', $userCard->card_id)
                                     ->where('created_by_id', Auth::user()->id)
                                     ->sum('points');
                $all_claims = Claim::where('card_id', $userCard->card_id)
                                    ->where('created_by_id', Auth::user()->id)
                                    ->get();

                // Return the view with the collected data.
                return view('frontend.pages.scan', compact('userCard', 'user_points', 'all_points', 'user_claims', 'all_claims', 'chart2'));

                } else {
                                    $user_points = Point::where('card_id', $userCard->card_id)
                                    ->sum('points');
                        dd($user_points);
                                    }
            } else {
                //Check if the user exist already

                if(Auth::check()){

                // If the card is not registered, direct to card registration view.
                return view('frontend.pages.add-card', compact('card'));

                } else {
                    return view('auth.login');

                }

            }            
        } else {
            // If the card does not exist, return a 404 view.
            return view('frontend.pages.invalid');
        }
    }

    /**
     * Check if the card exists in the database.
     *
     * @param string $card_code The card code to check.
     * @return mixed The Card model if found, false otherwise.
     */
    private function cardExist($card_code)
    {
        // Ensure the card code is not empty before querying the database.
        if (!empty($card_code)) {
            $card = Card::where('code', $card_code)->first();
            return $card ? $card : false;
        }
        return false;
    }
}
