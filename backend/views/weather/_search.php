<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\WeatherSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="weather-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'date') ?>

    <?= $form->field($model, 'cloudCover') ?>

    <?= $form->field($model, 'feelsLike') ?>

    <?= $form->field($model, 'humidity') ?>

    <?php // echo $form->field($model, 'pressure') ?>

    <?php // echo $form->field($model, 'temperature') ?>

    <?php // echo $form->field($model, 'windDirection') ?>

    <?php // echo $form->field($model, 'windSpeed') ?>

    <?php // echo $form->field($model, 'high') ?>

    <?php // echo $form->field($model, 'low') ?>

    <?php // echo $form->field($model, 'weatherDesc') ?>

    <?php // echo $form->field($model, 'chanceofFog') ?>

    <?php // echo $form->field($model, 'chanceOfRain') ?>

    <?php // echo $form->field($model, 'chanceOfSnow') ?>

    <?php // echo $form->field($model, 'sunrise') ?>

    <?php // echo $form->field($model, 'sunset') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
