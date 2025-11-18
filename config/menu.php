<?php
return [
    'sales' => [
        'title' => 'Sales',
        'icon' => 'sales',
        'permissions' => ['list_sale'],
        'children' => [
            'list' => [
                'title' => 'List Sales',
                'route' => 'sales/list',
                'permissions' => ['list_sale'],
            ],
            'create' => [
                'title' => 'Create Sale',
                'route' => 'sales/create',
                'permissions' => ['create_sale'],
            ],
        ],
    ],

    'payments' => [
        'title' => 'Payments',
        'icon' => 'payments',
        'permissions' => ['list_payment'],
        'children' => [
            'list' => [
                'title' => 'List Payments',
                'route' => 'payments/list',
                'permissions' => ['list_payment'],
            ],
            'create' => [
                'title' => 'Create Payment',
                'route' => 'payments/create',
                'permissions' => ['create_payment'],
            ],
        ],
    ],

    'expances' => [
        'title' => 'Expenses',
        'icon' => 'expances',
        'permissions' => ['list_expance'],
        'children' => [
            'list' => [
                'title' => 'List Expenses',
                'route' => 'expances/list',
                'permissions' => ['list_expance'],
            ],
            'create' => [
                'title' => 'Create Expense',
                'route' => 'expances/create',
                'permissions' => ['create_expance'],
            ],
        ],
    ],

    'companies' => [
        'title' => 'Companies',
        'icon' => 'companies',
        'permissions' => ['list_company'],
        'children' => [
            'list' => [
                'title' => 'List Companies',
                'route' => 'companies/list',
                'permissions' => ['list_company'],
            ],
            'create' => [
                'title' => 'Create Company',
                'route' => 'companies/create',
                'permissions' => ['create_company'],
            ],
            'update' => [
                'title' => 'Edit Company',
                'route' => 'companies/update',
                'permissions' => ['update_company'],
            ],
            'delete' => [
                'title' => 'Delete Company',
                'route' => 'companies/delete',
                'permissions' => ['delete_company'],
            ],
        ],
    ],

    'settings' => [
        'title' => 'Settings',
        'icon' => 'settings',
        'permissions' => ['list_product', 'list_user', 'list_role', 'list_material_type', 'list_material'],
        'children' => [

            // PRODUCTS
            'products' => [
                'title' => 'Products',
                'icon' => 'product',
                'permissions' => ['list_product'],
                'children' => [
                    'list' => [
                        'title' => 'List Products',
                        'route' => 'products/list',
                        'permissions' => ['list_product'],
                    ],
                    'create' => [
                        'title' => 'Create Product',
                        'route' => 'products/create',
                        'permissions' => ['create_product'],
                    ],
                    'update' => [
                        'title' => 'Edit Product',
                        'route' => 'products/update',
                        'permissions' => ['update_product'],
                    ],
                    'delete' => [
                        'title' => 'Delete Product',
                        'route' => 'products/delete',
                        'permissions' => ['delete_product'],
                    ],
                ],
            ],

            // USERS
            'users' => [
                'title' => 'Users',
                'icon' => 'users',
                'permissions' => ['list_user'],
                'children' => [
                    'list' => [
                        'title' => 'List Users',
                        'route' => 'users/list',
                        'permissions' => ['list_user'],
                    ],
                    'create' => [
                        'title' => 'Create User',
                        'route' => 'users/create',
                        'permissions' => ['create_user'],
                    ],
                    'update' => [
                        'title' => 'Edit User',
                        'route' => 'users/update',
                        'permissions' => ['update_user'],
                    ],
                    'delete' => [
                        'title' => 'Delete User',
                        'route' => 'users/delete',
                        'permissions' => ['delete_user'],
                    ],
                ],
            ],

            // ROLES
            'roles' => [
                'title' => 'Roles',
                'icon' => 'roles',
                'permissions' => ['list_role'],
                'children' => [
                    'list' => [
                        'title' => 'List Roles',
                        'route' => 'roles/list',
                        'permissions' => ['list_role'],
                    ],
                    'create' => [
                        'title' => 'Create Role',
                        'route' => 'roles/create',
                        'permissions' => ['create_role'],
                    ],
                    'update' => [
                        'title' => 'Edit Role',
                        'route' => 'roles/update',
                        'permissions' => ['update_role'],
                    ],
                    'delete' => [
                        'title' => 'Delete Role',
                        'route' => 'roles/delete',
                        'permissions' => ['delete_role'],
                    ],
                ],
            ],

            // MATERIAL TYPES
            'material_types' => [
                'title' => 'Material Types',
                'icon' => 'material_type',
                'permissions' => ['list_material_type'],
                'children' => [
                    'list' => [
                        'title' => 'List Material Types',
                        'route' => 'material_types/list',
                        'permissions' => ['list_material_type'],
                    ],
                    'create' => [
                        'title' => 'Create Material Type',
                        'route' => 'material_types/create',
                        'permissions' => ['create_material_type'],
                    ],
                    'update' => [
                        'title' => 'Edit Material Type',
                        'route' => 'material_types/update',
                        'permissions' => ['update_material_type'],
                    ],
                    'delete' => [
                        'title' => 'Delete Material Type',
                        'route' => 'material_types/delete',
                        'permissions' => ['delete_material_type'],
                    ],
                ],
            ],

            // MATERIALS
            'materials' => [
                'title' => 'Materials',
                'icon' => 'materials',
                'permissions' => ['list_material'],
                'children' => [
                    'list' => [
                        'title' => 'List Materials',
                        'route' => 'materials/list',
                        'permissions' => ['list_material'],
                    ],
                    'create' => [
                        'title' => 'Create Material',
                        'route' => 'materials/create',
                        'permissions' => ['create_material'],
                    ],
                    'update' => [
                        'title' => 'Edit Material',
                        'route' => 'materials/update',
                        'permissions' => ['update_material'],
                    ],
                    'delete' => [
                        'title' => 'Delete Material',
                        'route' => 'materials/delete',
                        'permissions' => ['delete_material'],
                    ],
                ],
            ],
        ],
    ],
];
