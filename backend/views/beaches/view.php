<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Beaches */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Beaches'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="beaches-view">

    <h1><?= Html::encode($this->title) ?></h1>

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
            'name:ntext',
            'type',
            'location:ntext',
            'longitude:ntext',
            'latitude:ntext',
            'reviewScore',
            'ratingStar',
            'offerExists',
            'descrip:ntext',
            'offerTitle:ntext',
            'offerDescription:ntext',
            'isPoolAvailable',
            'isGymAvailable',
            'isWifiAvailable',
            'isVisaPaymentAvailable',
            'isDiningInAvailable',
            'accomadtionType:ntext',
            'elgounaVoice:ntext',
            'email:ntext',
            'phoneNumber:ntext',
            'info:ntext',
            'facebookLink:ntext',
            'twitterLink:ntext',
            'instagramLink:ntext',
            'youtubeLink:ntext',
            'ord',
            'hidden',
            'category_id',
            'price_type',
            'popularity',
            'location_id',
            'place_type',
        ],
    ]) ?>

</div>
