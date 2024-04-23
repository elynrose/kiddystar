<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'tasks';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const OCCOURANCE_SELECT = [
        '1' => 'Only Once',
        '0' => 'Everyday',
    ];

    protected $fillable = [
        'task_name',
        'points',
        'occourance',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function assigned_tos()
    {
        return $this->belongsToMany(Child::class);
    }


    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function child()
    {
        return $this->belongsTo(Child::class);
    }

    public function created_by()
    {
        return $this->belongsTo(User::class);
    }

}
