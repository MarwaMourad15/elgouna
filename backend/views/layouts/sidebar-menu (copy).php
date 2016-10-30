<?php
use common\widgets\Menu;
//echo Yii::$app->request->scriptUrl;
echo Menu::widget(
    [
        'options' => [
            'class' => 'sidebar-menu'
        ],
        'items' => [
            /*[
                'label' => Yii::t('app', 'Home Page'),
                'url' => Yii::$app->homeUrl,
                'icon' => 'fa-dashboard',
                'active' => Yii::$app->request->url === Yii::$app->homeUrl
            ],*/
             [
                'label' => Yii::t('app', 'Home Page'),
                'url' => ['#'],
                'icon' => 'fa fa-book',
                'options' => [
                    'class' => 'treeview',
                    ],
                'items' => [
                    [
                        'label' => Yii::t('app', 'Slider'),
                        'url' => ['/home-slider/index'],
                        'icon' => 'fa fa-briefcase',
                        'active' => Yii::$app->request->scriptUrl === Yii::$app->params['siteLink'].'backend/web/'.'home-slider/index'
                        //'visible' => (Yii::$app->user->identity->username == 'admin'),
                    ],
                    [
                        'label' => Yii::t('app', 'Brief'),
                        'url' => ['/pages/update/1'],
                        'icon' => 'fa fa-book',
                        'active' => Yii::$app->request->scriptUrl === Yii::$app->params['siteLink'].'backend/web/'.'pages/update/1'
                    ],
                ],
            ],
            /*[
                'label' => Yii::t('app', 'Pages'),
                'url' => ['/pages/index'],
                'icon' => 'fa fa-desktop',
                'active' => Yii::$app->request->url === 'pages/index'
            ],*/
            [
                'label' => Yii::t('app', 'About us'),
                'url' => ['/about/index'],
                'icon' => 'fa fa-users',
                'active' => Yii::$app->request->scriptUrl === Yii::$app->params['siteLink'].'backend/web/'.'about/index'
            ],
            [
                'label' => Yii::t('app', 'Calibration'),
                'url' => ['/calibration/index'],
                'icon' => 'fa fa-users',
                'active' => Yii::$app->request->scriptUrl === Yii::$app->params['siteLink'].'backend/web/'.'calibration/index'
            ],
            [
                'label' => Yii::t('app', 'Aviation'),
                'url' => ['/aviation/index'],
                'icon' => 'fa fa-users',
                'active' => Yii::$app->request->scriptUrl === Yii::$app->params['siteLink'].'backend/web/'.'aviation/index'
            ],
            [
                'label' => Yii::t('app', 'Online Purchasing solution'),
                'url' => ['#'],
                'icon' => 'fa fa-book',
                'options' => [
                    'class' => 'treeview',
                ],
                'items' => [
                    [
                        'label' => Yii::t('app', 'Slider'),
                        'url' => ['/slider/index'],
                        'icon' => 'fa fa-briefcase',
                        'active' => Yii::$app->request->scriptUrl === Yii::$app->params['siteLink'].'backend/web/'.'home-slider/index/1'
                        //'visible' => (Yii::$app->user->identity->username == 'admin'),
                    ],
                    [
                        'label' => Yii::t('app', 'Brief'),
                        'url' => ['/pages/update/2'],
                        'icon' => 'fa fa-book',
                        'active' => Yii::$app->request->scriptUrl === Yii::$app->params['siteLink'].'backend/web/'.'pages/update/2'
                    ],
                ],
            ],


            [
                'label' => Yii::t('app', 'news & Events'),
                'url' => ['/news-event/index'],
                'icon' => 'fa fa-calendar',
                'active' => Yii::$app->request->scriptUrl === Yii::$app->params['siteLink'].'backend/web/'.'news-event/index'
            ],
            [
                'label' => Yii::t('app', 'Contact us'),
                'url' => ['/pages/update/3'],
                'icon' => 'fa fa-users',
                'active' => Yii::$app->request->scriptUrl === Yii::$app->params['siteLink'].'backend/web/'.'pages/update/3'
            ],
            /*[
                'label' => Yii::t('app', 'Library'),
                'url' => ['#'],
                'icon' => 'fa fa-book',
                'options' => [
                    'class' => 'treeview',
                ],
                'items' => [
                    [
                        'label' => Yii::t('app', 'Brief'),
                        'url' => ['/pages/update/4'],
                        'icon' => 'fa fa-briefcase',
                        'active' => Yii::$app->request->scriptUrl === Yii::$app->params['siteLink'].'backend/web/'.'pages/update/4'
                        //'visible' => (Yii::$app->user->identity->username == 'admin'),
                    ],
                    [
                        'label' => Yii::t('app', 'Categories'),
                        'url' => ['/lib-catalouge/index'],
                        'icon' => 'fa fa-briefcase',
                        'active' => Yii::$app->request->scriptUrl === Yii::$app->params['siteLink'].'backend/web/'.'lib-catalouge/index'
                        //'visible' => (Yii::$app->user->identity->username == 'admin'),
                    ],
                    [
                        'label' => Yii::t('app', 'Library Items'),
                        'url' => ['/library/index'],
                        'icon' => 'fa fa-book',
                        'active' => Yii::$app->request->scriptUrl === Yii::$app->params['siteLink'].'backend/web/'.'library/index'
                    ],
                ],
            ],
            [
                'label' => Yii::t('app', 'Download'),
                'url' => ['#'],
                'icon' => 'fa fa-download',
                'options' => [
                    'class' => 'treeview',
                ],
                'items' => [
                    [
                        'label' => Yii::t('app', 'Brief'),
                        'url' => ['/pages/update/5'],
                        'icon' => 'fa fa-briefcase',
                        'active' => Yii::$app->request->scriptUrl === Yii::$app->params['siteLink'].'backend/web/'.'pages/update/5'
                        //'visible' => (Yii::$app->user->identity->username == 'admin'),
                    ],
                    [
                        'label' => Yii::t('app', 'Categories'),
                        'url' => ['/down-catalouge/index'],
                        'icon' => 'fa fa-toggle-down',
                        'active' => Yii::$app->request->scriptUrl === Yii::$app->params['siteLink'].'backend/web/'.'down-catalouge/index'
                        //'visible' => (Yii::$app->user->identity->username == 'admin'),
                    ],
                    [
                        'label' => Yii::t('app', 'Downloads'),
                        'url' => ['/download/index'],
                        'icon' => 'fa fa-download',
                        'active' => Yii::$app->request->scriptUrl === Yii::$app->params['siteLink'].'backend/web/'.'download/index'
                    ],
                ],
            ],*/
            [
                'label' => Yii::t('app', 'Library'),
                'url' => ['/pages/update/4'],
                'icon' => 'fa fa-book',
                'active' => Yii::$app->request->scriptUrl === Yii::$app->params['siteLink'].'backend/web/'.'pages/update/4'
            ],
            [
                'label' => Yii::t('app', 'Download'),
                'url' => ['/pages/update/5'],
                'icon' => 'fa fa-download',
                'active' => Yii::$app->request->scriptUrl === Yii::$app->params['siteLink'].'backend/web/'.'pages/update/5'
            ],
            [
                'label' => Yii::t('app', 'Training'),
                'url' => ['/pages/update/6'],
                'icon' => 'fa fa-users',
                'active' => Yii::$app->request->scriptUrl === Yii::$app->params['siteLink'].'backend/web/'.'pages/update/6'
            ],
            [
                'label' => Yii::t('app', 'Advertisement'),
                'url' => ['/advertisment/index'],
                'icon' => 'fa fa-bullhorn',
                'active' => Yii::$app->request->scriptUrl === Yii::$app->params['siteLink'].'backend/web/'.'advertisment/index'
            ],
            /*[
                'label' => Yii::t('app', 'Newsletter'),
                'url' => ['/newsletter/index'],
                'icon' => 'fa fa-envelope-o',
                'active' => Yii::$app->request->scriptUrl === Yii::$app->params['siteLink'].'backend/web/'.'newsletter/index'
            ],*/
            /*[
                'label' => Yii::t('app', 'System'),
                'url' => ['#'],
                'icon' => 'fa fa-cog',
                'options' => [
                    'class' => 'treeview',
                ],
                'items' => [
                    [
                        'label' => Yii::t('app', 'User'),
                        'url' => ['/user/index'],
                        'icon' => 'fa fa-user',
                        //'visible' => (Yii::$app->user->identity->username == 'admin'),
                    ],
                    [
                        'label' => Yii::t('app', 'Role'),
                        'url' => ['/role/index'],
                        'icon' => 'fa fa-lock',
                    ],
                ],
            ],*/
        ]
    ]
);