<?php

namespace App\Observers;

use App\Models\Claim;
use App\Notifications\DataChangeEmailNotification;
use Illuminate\Support\Facades\Notification;

class ClaimActionObserver
{
    public function created(Claim $model)
    {
        $data  = ['action' => 'created', 'model_name' => 'Claim'];
        $users = \App\Models\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }
}
