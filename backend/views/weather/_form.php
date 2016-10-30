<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Weather */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="weather-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'cloudCover')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'feelsLike')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'humidity')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'pressure')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'temperature')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'windDirection')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'windSpeed')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'high')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'low')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'weatherDesc')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'chanceofFog')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'chanceOfRain')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'chanceOfSnow')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'sunrise')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'sunset')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
