<?php

return [
    'userManagement' => [
        'title'          => 'Gestionar usuarios',
        'title_singular' => 'Gestionar usuarios',
    ],
    'permission' => [
        'title'          => 'Permisos',
        'title_singular' => 'Permiso',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role' => [
        'title'          => 'Roles',
        'title_singular' => 'Rol',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'permissions'        => 'Permissions',
            'permissions_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user' => [
        'title'          => 'Usuarios',
        'title_singular' => 'Usuario',
        'fields'         => [
            'id'                           => 'ID',
            'id_helper'                    => ' ',
            'name'                         => 'Business Name',
            'name_helper'                  => ' ',
            'email'                        => 'Email',
            'email_helper'                 => ' ',
            'email_verified_at'            => 'Email verified at',
            'email_verified_at_helper'     => ' ',
            'password'                     => 'Password',
            'password_helper'              => ' ',
            'roles'                        => 'Roles',
            'roles_helper'                 => ' ',
            'remember_token'               => 'Remember Token',
            'remember_token_helper'        => ' ',
            'created_at'                   => 'Created at',
            'created_at_helper'            => ' ',
            'updated_at'                   => 'Updated at',
            'updated_at_helper'            => ' ',
            'deleted_at'                   => 'Deleted at',
            'deleted_at_helper'            => ' ',
            'verified'                     => 'Verified',
            'verified_helper'              => ' ',
            'verified_at'                  => 'Verified at',
            'verified_at_helper'           => ' ',
            'verification_token'           => 'Verification token',
            'verification_token_helper'    => ' ',
            'two_factor'                   => 'Two-Factor Auth',
            'two_factor_helper'            => ' ',
            'two_factor_code'              => 'Two-factor code',
            'two_factor_code_helper'       => ' ',
            'two_factor_expires_at'        => 'Two-factor expires at',
            'two_factor_expires_at_helper' => ' ',
            'type'                         => 'Type',
            'type_helper'                  => ' ',
            'paid'                         => 'Paid',
            'paid_helper'                  => ' ',
            'expires'                      => 'Expires',
            'expires_helper'               => ' ',
            'first_name'                   => 'First Name',
            'first_name_helper'            => ' ',
            'last_name'                    => 'Last Name',
            'last_name_helper'             => ' ',
            'state'                        => 'State',
            'state_helper'                 => ' ',
            'city'                         => 'City',
            'city_helper'                  => ' ',
            'street'                       => 'Street',
            'street_helper'                => ' ',
            'zip'                          => 'Zip',
            'zip_helper'                   => ' ',
            'partner_email'                => 'Partner Email',
            'partner_email_helper'         => ' ',
            'partner_password'             => 'Partner Password',
            'partner_password_helper'      => ' ',
        ],
    ],
    'userAlert' => [
        'title'          => 'User Alerts',
        'title_singular' => 'User Alert',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'alert_text'        => 'Alert Text',
            'alert_text_helper' => ' ',
            'alert_link'        => 'Alert Link',
            'alert_link_helper' => ' ',
            'user'              => 'Users',
            'user_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
        ],
    ],
    'cardBatch' => [
        'title'          => 'Card Batch',
        'title_singular' => 'Card Batch',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'batch_code'         => 'Batch Code',
            'batch_code_helper'  => ' ',
            'published'          => 'Published',
            'published_helper'   => ' ',
            'quantity'           => 'Quantity',
            'quantity_helper'    => ' ',
            'distrubuted'        => 'Distrubuted',
            'distrubuted_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
            'business'           => 'Business',
            'business_helper'    => ' ',
        ],
    ],
    'card' => [
        'title'          => 'Cards',
        'title_singular' => 'Card',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'code'              => 'Code',
            'code_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'card_batch'        => 'Card Batch',
            'card_batch_helper' => ' ',
        ],
    ],
    'userCard' => [
        'title'          => 'User Card',
        'title_singular' => 'User Card',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'card'              => 'Card',
            'card_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'created_by'        => 'Created By',
            'created_by_helper' => ' ',
            'children'          => 'Children',
            'children_helper'   => ' ',
        ],
    ],
    'point' => [
        'title'          => 'Stars',
        'title_singular' => 'Star',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'points'            => 'Points',
            'points_helper'     => ' ',
            'card'              => 'Card',
            'card_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'created_by'        => 'Created By',
            'created_by_helper' => ' ',
            'reason'            => 'Reason',
            'reason_helper'     => ' ',
        ],
    ],
    'reward' => [
        'title'          => 'Rewards',
        'title_singular' => 'Reward',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'photo'              => 'Photo',
            'photo_helper'       => ' ',
            'name'               => 'Name',
            'name_helper'        => ' ',
            'description'        => 'Description',
            'description_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
            'created_by'         => 'Created By',
            'created_by_helper'  => ' ',
            'points'             => 'Points',
            'points_helper'      => ' ',
        ],
    ],
    'claim' => [
        'title'          => 'Claims',
        'title_singular' => 'Claim',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'points'            => 'Points',
            'points_helper'     => ' ',
            'card'              => 'Card',
            'card_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'created_by'        => 'Created By',
            'created_by_helper' => ' ',
            'reward'            => 'Reward',
            'reward_helper'     => ' ',
        ],
    ],
    'child' => [
        'title'          => 'Children',
        'title_singular' => 'Child',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'first_name'        => 'First Name',
            'first_name_helper' => ' ',
            'last_name'         => 'Last Name',
            'last_name_helper'  => ' ',
            'dob'               => 'Dob',
            'dob_helper'        => ' ',
            'photo'             => 'Photo',
            'photo_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'created_by'        => 'Created By',
            'created_by_helper' => ' ',
            'unique'            => 'Unique ID',
            'unique_helper'     => ' ',
        ],
    ],
    'task' => [
        'title'          => 'Tasks',
        'title_singular' => 'Task',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'task_name'          => 'Task Name',
            'task_name_helper'   => ' ',
            'points'             => 'Points',
            'points_helper'      => ' ',
            'assigned_to'        => 'Assigned To',
            'assigned_to_helper' => ' ',
            'occourance'         => 'Occourance',
            'occourance_helper'  => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
            'created_by'         => 'Created By',
            'created_by_helper'  => ' ',
            'category'           => 'Category',
            'category_helper'    => ' ',
        ],
    ],
    'completed' => [
        'title'          => 'Completed',
        'title_singular' => 'Completed',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'task'              => 'Task',
            'task_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'created_by'        => 'Created By',
            'created_by_helper' => ' ',
            'child'             => 'Child',
            'child_helper'      => ' ',
        ],
    ],
    'category' => [
        'title'          => 'Category',
        'title_singular' => 'Category',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'name'               => 'Name',
            'name_helper'        => 'Category name',
            'description'        => 'Description',
            'description_helper' => ' ',
            'active'             => 'Active',
            'active_helper'      => ' ',
            'photo'              => 'Photo',
            'photo_helper'       => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],

];
