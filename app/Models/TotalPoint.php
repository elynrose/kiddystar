<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Claim;
use App\Models\Point;
use Auth;

class TotalPoint extends Model
{
    use HasFactory;

    public static function points($card_id){
        if(!empty($card_id)) {
            $claims =  Claim::where('card_id', $card_id)->sum('points');
            $points =  Point::where('card_id', $card_id)->sum('points');
        }
       $total = ($points - $claims);
       return number_format($total);

    }
}


