<?php

return [
    'products' => [
        'title' => 'Products',
        'icon' => 'product',
        'permissions' => ['see product', 'create product'],
        'children' => [
            'list' => [
                'title' => 'List Products',
                'route' => 'product/list',  
                'permissions' => ['see product'],
            ],
            'create' => [
                'title' => 'Create Product',
                'route' => 'product/create',  
                'permissions' => ['create product'],
            ],
        ],
    ],
];