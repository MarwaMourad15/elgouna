<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Services;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\ServicesHotel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="services-hotel-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'service_id')->dropDownList(ArrayHelper::map( Services::find()->all(), 'id', 'name' ),[ 'prompt' => '' ]) ?>

    <?= $form->field($model, 'hotel_id')->dropDownList(ArrayHelper::map( Hotels::find()->all(), 'id', 'name' ),[ 'prompt' => '' ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
