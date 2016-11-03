<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BeachesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Beaches');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="beaches-index">

    <div class="panel panel-primary">
        <div class="panel-heading"><h5><?= Html::encode($this->title) ?></h5></div>
        <div class="panel-body">


        <p>
        <?= Html::a(Yii::t('app', 'Create Beaches'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name:ntext',
            'type',
            'location:ntext',
            'longitude:ntext',
            // 'latitude:ntext',
            // 'reviewScore',
            // 'ratingStar',
            // 'offerExists',
            // 'descrip:ntext',
            // 'offerTitle:ntext',
            // 'offerDescription:ntext',
            // 'isPoolAvailable',
            // 'isGymAvailable',
            // 'isWifiAvailable',
            // 'isVisaPaymentAvailable',
            // 'isDiningInAvailable',
            // 'accomadtionType:ntext',
            // 'elgounaVoice:ntext',
            // 'email:ntext',
            // 'phoneNumber:ntext',
            // 'info:ntext',
            // 'facebookLink:ntext',
            // 'twitterLink:ntext',
            // 'instagramLink:ntext',
            // 'youtubeLink:ntext',
            // 'ord',
            // 'hidden',
            // 'category_id',
            // 'price_type',
            // 'popularity',
            // 'location_id',
            // 'place_type',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
</div>
</div>
