<?php

namespace App\Http\Controllers\Frontend;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use Auth;
use App\Models\UserCard;
use App\Models\Point;
use App\Models\Claim;
use LaravelDaily\LaravelCharts\Classes\LaravelFrontChart;
use Illuminate\Support\Facades\DB;


class HomeController
{
    public function index()
    {
        //Check if the user is a customer or business and redirect them to the appropriate page
        //Customer goes to frontend.home, business goes to frontend.business
        
        if(Auth::check()) {
            if(Auth::user()->type == 0) {
                
                //redirect to business
                $settings1 = [
                    'chart_title'           => 'Claims',
                    'chart_type'            => 'line',
                    'report_type'           => 'group_by_date',
                    'model'                 => 'App\Models\Claim',
                    'group_by_field'        => 'created_at',
                    'group_by_period'       => 'day',
                    'aggregate_function'    => 'sum',
                    'aggregate_field'       => 'points',
                    'filter_field'          => 'created_at',
                    'filter_days'           => '30',
                    'group_by_field_format' => 'Y-m-d H:i:s',
                    'column_class'          => 'col-md-6',
                    'entries_number'        => '5',
                    'translation_key'       => 'claim',
                    'user_id'               => Auth::user()->id,
                ];
        
                $chart1 = new LaravelChart($settings1);
        
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
                    'column_class'          => 'col-md-6',
                    'entries_number'        => '5',
                    'translation_key'       => 'point',
                    'user_id'               => Auth::user()->id,
                ];
        
                $chart2 = new LaravelChart($settings2);
        
                $userCards = UserCard::with(['card', 'children', 'created_by'])->where('created_by_id', Auth::user()->id)->get();
            
                return view('frontend.pages.parent', compact('chart1', 'chart2', 'userCards'));
            

            } elseif(Auth::user()->type == 1)  {

            $userCard = UserCard::with(['card', 'user', 'created_by'])->where('user_id', Auth::user()->id)->first();


            if ($userCard) {
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



                // Return the view with the collected data.
                return view('frontend.pages.customer-home', compact('userCard',  'chart2'));
          
                 }

            
        }

    }
}
}
