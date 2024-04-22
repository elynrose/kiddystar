<?php

namespace App\Observers;

use App\Models\Point;
use App\Notifications\DataChangeEmailNotification;
use Illuminate\Support\Facades\Notification;

class PointActionObserver
{
    public function created(Point $model)
    {
        $data  = ['action' => 'created', 'model_name' => 'Point'];
        $users = \App\Models\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }
}
