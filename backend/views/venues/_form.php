<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Venues */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="venues-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'venueUsername')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'venuePass')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'location')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'longitude')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'latitude')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'reviewScore')->textInput() ?>

    <?= $form->field($model, 'ratingStar')->textInput() ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'offerCheck')->textInput() ?>

    <?= $form->field($model, 'offerTitle')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'offerDescription')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wifiCheck')->textInput() ?>

    <?= $form->field($model, 'visaCheck')->textInput() ?>

    <?= $form->field($model, 'diningCheck')->textInput() ?>

    <?= $form->field($model, 'elgounaVoice')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phoneNumber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'info')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'facebookLink')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'twitterLink')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'instagramLink')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'youtubeLink')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ord')->textInput() ?>

    <?= $form->field($model, 'merchant_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'secure_hash')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'category_id')->textInput() ?>

    <?= $form->field($model, 'price_type')->textInput() ?>

    <?= $form->field($model, 'popularity')->textInput() ?>

    <?= $form->field($model, 'location_id')->textInput() ?>

    <?= $form->field($model, 'place_type')->textInput() ?>

    <?= $form->field($model, 'category_type')->textInput() ?>

    <?= $form->field($model, 'taste')->textInput() ?>

    <?= $form->field($model, 'cleanliness')->textInput() ?>

    <?= $form->field($model, 'rating')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
