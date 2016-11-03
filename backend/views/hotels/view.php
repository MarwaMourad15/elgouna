<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Hotels */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Hotels'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hotels-view">

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
            'name:ntext',
            'location:ntext',
            'longitude:ntext',
            'latitude:ntext',
            'bookingLink',
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
            'virtualTourLink:url',
            'pid',
            'ord',
            'hidden',
        ],
    ]) ?>

</div>
</div>
</div>
