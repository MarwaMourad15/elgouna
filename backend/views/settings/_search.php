<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SettingsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="settings-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'bookingURL') ?>

    <?= $form->field($model, 'facebookURL') ?>

    <?= $form->field($model, 'elgounaURL') ?>

    <?= $form->field($model, 'twitterURL') ?>

    <?php // echo $form->field($model, 'youtubeURL') ?>

    <?php // echo $form->field($model, 'instagramURL') ?>

    <?php // echo $form->field($model, 'snapchatURL') ?>

    <?php // echo $form->field($model, 'elgounaPhone') ?>

    <?php // echo $form->field($model, 'elgounaSMS') ?>

    <?php // echo $form->field($model, 'elgounaemail') ?>

    <?php // echo $form->field($model, 'about') ?>

    <?php // echo $form->field($model, 'paymobAPIKey') ?>

    <?php // echo $form->field($model, 'paymobSecretKey') ?>

    <?php // echo $form->field($model, 'paymobMerchantId') ?>

    <?php // echo $form->field($model, 'paymobSecureHash') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
