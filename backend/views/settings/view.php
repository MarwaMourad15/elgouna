<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Settings */

$this->title = 'App. Settings';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Settings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="settings-view">

    <div class="panel panel-primary">
        <div class="panel-heading"><h5><?= Html::encode($this->title) ?></h5></div>
        <div class="panel-body">

        <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'bookingURL:ntext',
            'facebookURL:ntext',
            'elgounaURL:ntext',
            'twitterURL:ntext',
            'youtubeURL:ntext',
            'instagramURL:ntext',
            'snapchatURL:url',
            'elgounaPhone:ntext',
            'elgounaSMS:ntext',
            'elgounaemail:ntext',

            [
                'attribute' => 'about',
                'format'=>'raw',
                'value'=>$model->about,
            ],

            'paymobAPIKey',
            'paymobSecretKey',
            'paymobMerchantId',
            'paymobSecureHash',
        ],
    ]) ?>

</div>
</div>
</div>
