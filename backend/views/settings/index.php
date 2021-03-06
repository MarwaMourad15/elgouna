<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SettingsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Settings');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="settings-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'bookingURL:ntext',
            'facebookURL:ntext',
            'elgounaURL:ntext',
            'twitterURL:ntext',
            // 'youtubeURL:ntext',
            // 'instagramURL:ntext',
            // 'snapchatURL:url',
            // 'elgounaPhone:ntext',
            // 'elgounaSMS:ntext',
            // 'elgounaemail:ntext',
            // 'about',
            // 'paymobAPIKey',
            // 'paymobSecretKey',
            // 'paymobMerchantId',
            // 'paymobSecureHash',

            ['class' => 'yii\grid\ActionColumn',
            'templates'=>'{view} {update}'],
        ],
    ]); ?>
</div>
