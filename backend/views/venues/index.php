<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\VenuesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Venues');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="venues-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Venues'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'venueUsername',
            'venuePass',
            'name',
            'type',
            // 'location',
            // 'longitude',
            // 'latitude',
            // 'reviewScore',
            // 'ratingStar',
            // 'description:ntext',
            // 'offerCheck',
            // 'offerTitle',
            // 'offerDescription',
            // 'wifiCheck',
            // 'visaCheck',
            // 'diningCheck',
            // 'elgounaVoice',
            // 'email:email',
            // 'phoneNumber',
            // 'info',
            // 'facebookLink',
            // 'twitterLink',
            // 'instagramLink',
            // 'youtubeLink',
            // 'ord',
            // 'merchant_id',
            // 'secure_hash',
            // 'category_id',
            // 'price_type',
            // 'popularity',
            // 'location_id',
            // 'place_type',
            // 'category_type',
            // 'taste',
            // 'cleanliness',
            // 'rating',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
