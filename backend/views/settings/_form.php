<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Settings */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="settings-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'bookingURL')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'facebookURL')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'elgounaURL')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'twitterURL')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'youtubeURL')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'instagramURL')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'snapchatURL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'elgounaPhone')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'elgounaSMS')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'elgounaemail')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'about')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'paymobAPIKey')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'paymobSecretKey')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'paymobMerchantId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'paymobSecureHash')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
