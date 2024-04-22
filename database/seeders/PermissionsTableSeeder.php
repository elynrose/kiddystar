<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 18,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 19,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 20,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 21,
                'title' => 'card_batch_create',
            ],
            [
                'id'    => 22,
                'title' => 'card_batch_edit',
            ],
            [
                'id'    => 23,
                'title' => 'card_batch_show',
            ],
            [
                'id'    => 24,
                'title' => 'card_batch_delete',
            ],
            [
                'id'    => 25,
                'title' => 'card_batch_access',
            ],
            [
                'id'    => 26,
                'title' => 'card_create',
            ],
            [
                'id'    => 27,
                'title' => 'card_edit',
            ],
            [
                'id'    => 28,
                'title' => 'card_show',
            ],
            [
                'id'    => 29,
                'title' => 'card_delete',
            ],
            [
                'id'    => 30,
                'title' => 'card_access',
            ],
            [
                'id'    => 31,
                'title' => 'user_card_create',
            ],
            [
                'id'    => 32,
                'title' => 'user_card_edit',
            ],
            [
                'id'    => 33,
                'title' => 'user_card_show',
            ],
            [
                'id'    => 34,
                'title' => 'user_card_delete',
            ],
            [
                'id'    => 35,
                'title' => 'user_card_access',
            ],
            [
                'id'    => 36,
                'title' => 'point_create',
            ],
            [
                'id'    => 37,
                'title' => 'point_edit',
            ],
            [
                'id'    => 38,
                'title' => 'point_show',
            ],
            [
                'id'    => 39,
                'title' => 'point_delete',
            ],
            [
                'id'    => 40,
                'title' => 'point_access',
            ],
            [
                'id'    => 41,
                'title' => 'reward_create',
            ],
            [
                'id'    => 42,
                'title' => 'reward_edit',
            ],
            [
                'id'    => 43,
                'title' => 'reward_show',
            ],
            [
                'id'    => 44,
                'title' => 'reward_delete',
            ],
            [
                'id'    => 45,
                'title' => 'reward_access',
            ],
            [
                'id'    => 46,
                'title' => 'claim_create',
            ],
            [
                'id'    => 47,
                'title' => 'claim_edit',
            ],
            [
                'id'    => 48,
                'title' => 'claim_show',
            ],
            [
                'id'    => 49,
                'title' => 'claim_delete',
            ],
            [
                'id'    => 50,
                'title' => 'claim_access',
            ],
            [
                'id'    => 51,
                'title' => 'child_create',
            ],
            [
                'id'    => 52,
                'title' => 'child_edit',
            ],
            [
                'id'    => 53,
                'title' => 'child_show',
            ],
            [
                'id'    => 54,
                'title' => 'child_delete',
            ],
            [
                'id'    => 55,
                'title' => 'child_access',
            ],
            [
                'id'    => 56,
                'title' => 'task_create',
            ],
            [
                'id'    => 57,
                'title' => 'task_edit',
            ],
            [
                'id'    => 58,
                'title' => 'task_show',
            ],
            [
                'id'    => 59,
                'title' => 'task_delete',
            ],
            [
                'id'    => 60,
                'title' => 'task_access',
            ],
            [
                'id'    => 61,
                'title' => 'completed_create',
            ],
            [
                'id'    => 62,
                'title' => 'completed_edit',
            ],
            [
                'id'    => 63,
                'title' => 'completed_show',
            ],
            [
                'id'    => 64,
                'title' => 'completed_delete',
            ],
            [
                'id'    => 65,
                'title' => 'completed_access',
            ],
            [
                'id'    => 66,
                'title' => 'category_create',
            ],
            [
                'id'    => 67,
                'title' => 'category_edit',
            ],
            [
                'id'    => 68,
                'title' => 'category_show',
            ],
            [
                'id'    => 69,
                'title' => 'category_delete',
            ],
            [
                'id'    => 70,
                'title' => 'category_access',
            ],
            [
                'id'    => 71,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
