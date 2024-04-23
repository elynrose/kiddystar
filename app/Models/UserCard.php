<?php

namespace App\Models;

use App\Traits\MultiTenantModelTrait;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Point;

class UserCard extends Model
{
    use SoftDeletes, MultiTenantModelTrait, HasFactory;

    public $table = 'user_cards';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'card_id',
        'user_id',
        'children_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function card()
    {
        return $this->belongsTo(Card::class, 'card_id');
    }

    public function children()
    {
        return $this->belongsTo(Child::class, 'children_id');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function count_points($card_id, $created_by_id){
        return Point::where('card_id', $card_id)->where('created_by_id', $created_by_id)->sum();
    }
}
