<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Venues */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Venues'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="venues-view">

     <div class="panel panel-primary">
        <div class="panel-heading"><h5><?= Html::encode($this->title) ?></h5></div>
        <div class="panel-body">

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'venueUsername',
            'venuePass',
            'name',
            'type',
            'location',
            'longitude',
            'latitude',
            'reviewScore',
            'ratingStar',
            'description:ntext',
            'offerCheck',
            'offerTitle',
            'offerDescription',
            'wifiCheck',
            'visaCheck',
            'diningCheck',
            'elgounaVoice',
            'email:email',
            'phoneNumber',
            'info',
            'facebookLink',
            'twitterLink',
            'instagramLink',
            'youtubeLink',
            'ord',
            'merchant_id',
            'secure_hash',
            'category_id',
            'price_type',
            'popularity',
            'location_id',
            'place_type',
            'category_type',
            'taste',
            'cleanliness',
            'rating',
        ],
    ]) ?>

</div>
</div>
</div>
