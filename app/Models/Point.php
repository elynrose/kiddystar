<?php

namespace App\Models;

use App\Traits\MultiTenantModelTrait;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Point extends Model
{
    use SoftDeletes, MultiTenantModelTrait, HasFactory;

    public $table = 'points';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'points',
        'card_id',
        'reason',
        'created_at',
        'updated_at',
        'deleted_at',
        'created_by_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public static function boot()
    {
        parent::boot();
     //   self::observe(new \App\Observers\PointActionObserver);
    }

    public function card()
    {
        return $this->belongsTo(Card::class, 'card_id');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
    
    public function total_points($card_id, $created_by_id)
    {
        return Point::where('card_id', $card_id)->where('created_by_id', $created_by_id)->sum();
    }
}
