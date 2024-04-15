<?php
return [
    'module' => [
        [
            'id' => 'dashboard',
            'route' => 'dashboard.index',
            'icon' => 'icofont-home',
            'title' => 'Bảng điều khiển',
            'activeCondition' => ['dashboard.*'],
        ],
        [
            'id' => 'user',
            'route' => '',
            'icon' => 'icofont-users',
            'title' => 'QL Thành viên',
            'activeCondition' => ['user.*', 'permission.*'],
            'subMenu' => [
                [
                    'title' => 'QL Thành viên',
                    'route' => 'user.index',
                    'activeCondition' => ['user.index', 'user.create', 'user.edit'],
                ],
                [
                    'title' => 'QL Nhóm thành viên',
                    'route' => 'user.catalogue.index',
                    'activeCondition' => ['user.catalogue.*']
                ],
                [
                    'title' => 'QL Quyền',
                    'route' => 'permission.index',
                    'activeCondition' => ['permission.*']
                ],
            ]
        ],

        [
            'id' => 'post',
            'route' => '',
            'icon' => 'icofont-newspaper',
            'title' => 'QL Bài viết',
            'activeCondition' => ['post.*'],
            'subMenu' => [
                [
                    'title' => 'QL Bài viết',
                    'route' => 'post.index',
                    'activeCondition' => ['post.index', 'post.create', 'post.edit'],
                ],
                [
                    'title' => 'QL Nhóm bài viết',
                    'route' => 'post.catalogue.index',
                    'activeCondition' => ['post.catalogue.*']
                ],
            ]
        ],

        [
            'id' => 'product',
            'route' => '',
            'icon' => 'icofont-box',
            'title' => 'QL Sản phẩm',
            'activeCondition' => ['product.*', 'attribute.*'],
            'subMenu' => [
                [
                    'title' => 'QL Sản phẩm',
                    'route' => 'product.index',
                    'activeCondition' => ['product.index', 'product.create', 'product.edit'],
                ],
                [
                    'title' => 'QL Nhóm sản phẩm',
                    'route' => 'product.catalogue.index',
                    'activeCondition' => ['product.catalogue.*']
                ],
                [
                    'title' => 'QL Thuộc tính',
                    'route' => 'attribute.index',
                    'activeCondition' => ['attribute.index', 'attribute.create', 'attribute.edit'],
                ],
                [
                    'title' => 'QL Nhóm thuộc tính',
                    'route' => 'attribute.catalogue.index',
                    'activeCondition' => ['attribute.catalogue.*']
                ],
            ]
        ],
        [
            'id' => 'menu',
            'route' => '',
            'icon' => 'icofont-ui-settings',
            'title' => 'QL menu',
            'activeCondition' => ['menu.*'],
            'subMenu' => [
                [
                    'title' => 'Cài đặt menu',
                    'route' => 'menu.index',
                    'activeCondition' => ['menu.*']
                ],

            ]
        ],
        [
            'id' => 'generalConfig',
            'route' => '',
            'icon' => 'icofont-ui-settings',
            'title' => 'Cấu hình chung',
            'activeCondition' => ['language.*', 'generate.*', 'system.*'],
            'subMenu' => [
                [
                    'title' => 'QL Ngôn ngữ',
                    'route' => 'language.index',
                    'activeCondition' => ['language.*']
                ],
                [
                    'title' => 'QL Module',
                    'route' => 'generate.index',
                    'activeCondition' => ['generate.*']
                ],
                [
                    'title' => 'Cấu hình hệ thống',
                    'route' => 'system.index',
                    'activeCondition' => ['system.*']
                ],
            ]
        ],

    ]
];
