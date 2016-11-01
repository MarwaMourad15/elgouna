<?php

namespace api\controllers;

use backend\models\Location;

use backend\models\Settings;
use Yii;
use yii\filters\VerbFilter;

/**
 * Class SettingController
 * @package frontend\controllers
 */
class PaymobController extends ApiController
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'success' => ['get'],
                    'locations' => ['get'],
                    'upload-photo' => ['post'],
                ],

            ]
        ];
    }

    public function actionSuccess()
    {
        print_r($_REQUEST);
    }
}
