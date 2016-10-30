<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\HotelsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Hotels');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hotels-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Hotels'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name:ntext',
            'location:ntext',
            'longitude:ntext',
            'latitude:ntext',
            // 'bookingLink',
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
            // 'virtualTourLink:url',
            // 'pid',
            // 'ord',
            // 'hidden',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
