<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\WeatherSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Weathers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="weather-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Weather'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'date',
            'cloudCover:ntext',
            'feelsLike:ntext',
            'humidity:ntext',
            // 'pressure:ntext',
            // 'temperature:ntext',
            // 'windDirection:ntext',
            // 'windSpeed:ntext',
            // 'high:ntext',
            // 'low:ntext',
            // 'weatherDesc:ntext',
            // 'chanceofFog:ntext',
            // 'chanceOfRain:ntext',
            // 'chanceOfSnow:ntext',
            // 'sunrise:ntext',
            // 'sunset:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
