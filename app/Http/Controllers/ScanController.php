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
    public function index(Request $request)
    {
        $card = $this->cardExist($request->card);

        if ($card) {
            // Check if the card is registered to a user
            $userCard = UserCard::with('children')->where('card_id', $card->id)->first();

            if ($userCard) {
                // User is logged in
                if (Auth::check()) {
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

                    $user_points = Point::where('card_id', $userCard->card_id)
                                        ->where('created_by_id', Auth::user()->id)
                                        ->sum('points');

                    $user_claims = Claim::where('card_id', $userCard->card_id)
                                         ->where('created_by_id', Auth::user()->id)
                                         ->sum('points');

                    $all_points = Point::where('card_id', $userCard->card_id)
                    ->where('created_by_id', Auth::user()->id)
                    ->get();

                    return view('frontend.pages.scan', compact('userCard', 'user_points', 'all_points', 'user_claims', 'chart2'));
                } else {
                    // User not logged in
                    $user_points = Point::where('card_id', $userCard->card_id)
                                        ->sum('points');
                    $user_claims = Claim::where('card_id', $userCard->card_id)
                                         ->sum('points');
                    $total_points_earned = ($user_points - $user_claims);

                    $name = $userCard->children->first_name.' '.$userCard->children->last_name;


                    return view('frontend.pages.mypoints', compact('total_points_earned', 'name'));
                }
            } else {
                // User is logged in
                if (Auth::check()) {
                    // If the card is not registered, direct to card registration view.
                    return view('frontend.pages.add-card', compact('card'));
                } else {
                    // User not logged in
                    return view('auth.login');
                }
            }
        } else {
            // Card does not exist
            return view('frontend.pages.invalid');
        }
    }

    private function cardExist($card_code)
    {
        if (!empty($card_code)) {
            $card = Card::where('code', $card_code)->first();
            return $card ? $card : false;
        }
        return false;
    }
}
