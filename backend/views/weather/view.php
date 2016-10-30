<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Weather */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Weathers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="weather-view">

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
            'date',
            'cloudCover:ntext',
            'feelsLike:ntext',
            'humidity:ntext',
            'pressure:ntext',
            'temperature:ntext',
            'windDirection:ntext',
            'windSpeed:ntext',
            'high:ntext',
            'low:ntext',
            'weatherDesc:ntext',
            'chanceofFog:ntext',
            'chanceOfRain:ntext',
            'chanceOfSnow:ntext',
            'sunrise:ntext',
            'sunset:ntext',
        ],
    ]) ?>

</div>
