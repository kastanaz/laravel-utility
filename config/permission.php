<?php

return [
    'role' => [
        // 'model' => \App\Kastanaz\LaravelUtility\Models\Role::class,
        'superadmin_level' => 1
    ],
    'list' => [
        [
            'name' => 'dashboard',
            'alias' => 'permission.dashboard',
            'permission' => [
                'create' => false,
                'read' => true,
                'update' => false,
                'delete' => false,
                'manage_other' => true
            ]
        ],
        [
            'name' => 'user',
            'alias' => 'permission.user',
            'permission' => [
                'create' => true,
                'read' => true,
                'update' => true,
                'delete' => true,
                'manage_other' => false
            ]
        ],
        [
            'name' => 'role',
            'alias' => 'permission.role',
            'permission' => [
                'create' => true,
                'read' => true,
                'update' => true,
                'delete' => true,
                'manage_other' => false
            ]
        ],
        [
            'name' => 'setting',
            'alias' => 'permission.setting',
            'permission' => [
                'create' => false,
                'read' => true,
                'update' => true,
                'delete' => false,
                'manage_other' => false
            ]
        ],
    ]
];
