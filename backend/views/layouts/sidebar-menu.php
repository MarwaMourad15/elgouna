<?php
use common\widgets\Menu;
//echo Yii::$app->request->scriptUrl;
echo Menu::widget(
    [
        'options' => [
            'class' => 'sidebar-menu'
        ],
        'items' => [
            [
                'label' => Yii::t('app', 'Who We Are'),
                'url' => ['settings/index'],
                'icon' => 'fa-dashboard',
                'active' => (Yii::$app->controller->id === 'settings'),
            ],
            [
                'label' => Yii::t('app', 'Locations'),
                'url' => ['location/index'],
                'icon' => 'fa-dashboard',
                'active' => (Yii::$app->controller->id === 'location'),
            ],
            [
                'label' => Yii::t('app', 'Hotels'),
                'url' => ['#'],
                'icon' => 'fa fa-cog',
                'options' => [
                    'class' => 'treeview',
                ],
                'items' => [
                    [
                        'label' => Yii::t('app', 'Services'),
                        'url' => ['/services/index'],
                        'icon' => 'fa fa-user',
                        'active' => (Yii::$app->controller->id === 'services'),
                        //'visible' => (Yii::$app->user->identity->username == 'admin'),
                    ],
                    [
                        'label' => Yii::t('app', 'Hotels'),
                        'url' => ['/hotels/index'],
                        'icon' => 'fa fa-user',
                        'active' => (Yii::$app->controller->id === 'hotels'),
                        //'visible' => (Yii::$app->user->identity->username == 'admin'),
                    ],
[
                        'label' => Yii::t('app', 'Hotel Review'),
                        'url' => ['/hotel-review/index'],
                        'icon' => 'fa fa-user',
                        'active' => (Yii::$app->controller->id === 'hotel-review'),
                        //'visible' => (Yii::$app->user->identity->username == 'admin'),
                    ],

                ],
            ],

            [
                'label' => Yii::t('app', 'Dining'),
                'url' => ['#'],
                'icon' => 'fa fa-cog',
                'options' => [
                    'class' => 'treeview',
                ],
                'items' => [
                    [
                        'label' => Yii::t('app', 'Categories'),
                        'url' => ['/venue-category/index?type=0'],
                        'icon' => 'fa fa-user',
                        'active' => (Yii::$app->controller->id === 'venue-category'),
                        //'visible' => (Yii::$app->user->identity->username == 'admin'),
                    ],
                    [
                        'label' => Yii::t('app', 'Dining'),
                        'url' => ['/venues/index?type=0'],
                        'icon' => 'fa fa-user',
                        'active' => (Yii::$app->controller->id === 'venues'),
                        //'visible' => (Yii::$app->user->identity->username == 'admin'),
                    ],
                ],
            ],
            [
                'label' => Yii::t('app', 'Night Life'),
                'url' => ['#'],
                'icon' => 'fa fa-cog',
                'options' => [
                    'class' => 'treeview',
                ],
                'items' => [
                    [
                        'label' => Yii::t('app', 'Categories'),
                        'url' => ['/venue-category/index?type=1'],
                        'icon' => 'fa fa-user',
                        'active' => (Yii::$app->controller->id === 'venue-category'),
                        //'visible' => (Yii::$app->user->identity->username == 'admin'),
                    ],
                    [
                        'label' => Yii::t('app', 'Night Life'),
                        'url' => ['/venues/index?type=1'],
                        'icon' => 'fa fa-user',
                        'active' => (Yii::$app->controller->id === 'venues'),
                        //'visible' => (Yii::$app->user->identity->username == 'admin'),
                    ],
                ],
            ],

            [
                'label' => Yii::t('app', 'Things to do'),
                'url' => ['#'],
                'icon' => 'fa fa-cog',
                'options' => [
                    'class' => 'treeview',
                ],
                'items' => [
                    [
                        'label' => Yii::t('app', 'Categories'),
                        'url' => ['/beach-category/index'],
                        'icon' => 'fa fa-user',
                        'active' => (Yii::$app->controller->id === 'beach-category'),
                        //'visible' => (Yii::$app->user->identity->username == 'admin'),
                    ],
                    [
                        'label' => Yii::t('app', 'Things to do'),
                        'url' => ['/beaches/index'],
                        'icon' => 'fa fa-user',
                        'active' => (Yii::$app->controller->id === 'beaches'),
                        //'visible' => (Yii::$app->user->identity->username == 'admin'),
                    ],

                    [
                        'label' => Yii::t('app', 'Review'),
                        'url' => ['/beach-review/index'],
                        'icon' => 'fa fa-user',
                        'active' => (Yii::$app->controller->id === 'beach-review'),
                        //'visible' => (Yii::$app->user->identity->username == 'admin'),
                    ],
                ],
            ],

            /*[
                'label' => Yii::t('app', 'Home Page'),
                'url' => Yii::$app->homeUrl,
                'icon' => 'fa-dashboard',
                'active' => Yii::$app->request->url === Yii::$app->homeUrl
            ],*/
            /*[
                'label' => Yii::t('app', 'Users'),
                'url' => ['users/index'],
                'icon' => 'fa-dashboard',
                'active' => (Yii::$app->controller->id === 'users'),
            ],
            [
                'label' => Yii::t('app', 'Orders'),
                'url' => ['users/index'],
                'icon' => 'fa-dashboard',
                'active' => (Yii::$app->controller->id === 'users'),
            ],*/
            [
                'label' => Yii::t('app', 'Weather'),
                'url' => ['weather/index'],
                'icon' => 'fa-dashboard',
                'active' => (Yii::$app->controller->id === 'weather'),
            ],
            [
                'label' => Yii::t('app', 'Contact us'),
                'url' => ['contact/index'],
                'icon' => 'fa-dashboard',
                'active' => (Yii::$app->controller->id === 'contact'),
            ],
            [
                'label' => Yii::t('app', 'System'),
                'url' => ['#'],
                'icon' => 'fa fa-cog',
                'options' => [
                    'class' => 'treeview',
                ],
                'items' => [
                    [
                        'label' => Yii::t('app', 'Admins'),
                        'url' => ['/user/index'],
                        'icon' => 'fa fa-user',
                        'active' => (Yii::$app->controller->id === 'user'),
                        //'visible' => (Yii::$app->user->identity->username == 'admin'),
                    ],
                ],
            ],
        ]
    ]
);