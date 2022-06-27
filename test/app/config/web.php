<?php

return [
    'id' => 'app-web',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
    ],
    'bootstrap' => ['adminlte'],
    'modules' => [
        'adminlte' => [
            'class' => \ashtokalo\yii2\adminlte\Module::class,
        ],
    ],
    'components' => [
        'navbar' => [
            'class' => \ashtokalo\yii2\adminlte\widgets\Navbar::class,
            'items' => [
                'menu' => ['items' => [
                    'pushmenu' => \ashtokalo\yii2\adminlte\widgets\NavbarPushMenu::class,
                    [
                        'label' => 'Home',
                        'url' => '/',
                    ],
                    [
                        'label' => 'Contact',
                        'url' => '/',
                    ]
                ]],
                'links' => [
                    'class' => \ashtokalo\yii2\adminlte\widgets\NavbarLinks::class,
                    'items' => [
                        'fullscreen' => \ashtokalo\yii2\adminlte\widgets\NavbarFullscreen::class,
                        'control-sidebar' => \ashtokalo\yii2\adminlte\widgets\NavbarControlSidebar::class,
                    ],
                ],
            ],
        ],
        'sidebar' => [
            'class' => \ashtokalo\yii2\adminlte\widgets\Sidebar::class,
            'header' => [
                'class' => \ashtokalo\yii2\adminlte\widgets\SidebarLogo::class,
                'logo' => '@almasaeed2010/img/AdminLTELogo.png',
                'assets' => ['@almasaeed2010' => \ashtokalo\yii2\adminlte\assets\AdminLteAsset::class],
            ],
            'footer' => null,
            'items' => [
                'user' => [
                    'class' => \ashtokalo\yii2\adminlte\widgets\SidebarBadge::class,
                    'avatar' => '@almasaeed2010/img/user2-160x160.jpg',
                    'name' => 'Alexander Pierce',
                    'url' => '/',
                    'assets' => ['@almasaeed2010' => \ashtokalo\yii2\adminlte\assets\AdminLteAsset::class],
                ],
                'search' => [
                    'class' => \ashtokalo\yii2\adminlte\widgets\SidebarSearch::class,
                ],
                'menu' => [
                    'items' => [
                        'dashboard' => [
                            'label' => 'Dashboard',
                            'url' => '/',
                            'icon' => 'fa-tachometer-alt',
                        ],
                        'widgets' => [
                            'label' => 'Widgets',
                            'url' => '/',
                            'icon' => 'fa-th',
                            'badge' => [
                                'label' => 'New',
                                'style' => 'badge-danger',
                                'title' => 'New Widgets',
                            ],
                        ],
                        'layout-options' => [
                            'label' => 'Layouts',
                            'url' => '/',
                            'icon' => 'fa-copy',
                            'badge' => [
                                'label' => '6',
                                'style' => 'badge-info',
                            ],
                            'items' => [
                                [
                                    'label' => 'Top Navigation',
                                    'url' => '?layout=top',
                                    'icon' => 'fa-circle',
                                ],
                                [
                                    'label' => 'Top Navigation + Sidebar',
                                    'url' => '?layout=topsidebar',
                                    'icon' => 'fa-circle',
                                ],
                                [
                                    'label' => 'Boxed',
                                    'url' => '?layout=boxed',
                                    'icon' => 'fa-circle',
                                ],
                                [
                                    'label' => 'Fixed Sidebar',
                                    'url' => ['/site/index', 'layout' => 'fixedsidebar'],
                                    'icon' => 'fa-circle',
                                ],
                                [
                                    'label' => 'Fixed Sidebar + Custom',
                                    'url' => '?layout=fixedsidebarcustom',
                                    'icon' => 'fa-circle',
                                ],
                            ],
                        ],
                        [
                            'label' => 'EXAMPLES',
                        ],
                        [
                            'label' => 'Calendar',
                            'url' => '/',
                            'icon' => 'fa-calendar-alt',
                        ],
                    ],
                ],
            ],
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'vxMC0AqCL5q_PMHm-nlsu6YpMmasT5-7',
        ],
        'user' => [
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '<controller:\w+>/<action:(\w|-)+>' => '<controller>/<action>',
                '<controller:\w+>/<action:(\w|-)+>/<id:\d+>' => '<controller>/<action>',
            ],
        ],
        'assetManager' => [
            'bundles' => [
                \yii\web\JqueryAsset::class => [
                    'class' => \ashtokalo\yii2\adminlte\assets\AdminLteJqueryAsset::class,
                ],
                \nullref\datatable\assets\DataTableAsset::class => [
                    'class' => \ashtokalo\yii2\adminlte\assets\AdminLteDataTablesAsset::class,
                ],
            ]
        ],
    ],
    'container' => [
        'definitions' => [
            \yii\widgets\LinkPager::class => [
                'class' => \zhuravljov\yii\pagination\LinkPager::class,
            ],
            \zhuravljov\yii\pagination\LinkPager::class => [
                'maxButtonCount' => 5,
            ],
            \zhuravljov\yii\pagination\LinkSizer::class => [
                'sizes' => [10, 20, 50, 100, 250],
            ],
            \yii\grid\GridView::class => [
                'layout' => '{items}{summary}{pager}',
            ]
        ],
    ],
];
