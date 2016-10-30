<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\BeachesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="beaches-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'type') ?>

    <?= $form->field($model, 'location') ?>

    <?= $form->field($model, 'longitude') ?>

    <?php // echo $form->field($model, 'latitude') ?>

    <?php // echo $form->field($model, 'reviewScore') ?>

    <?php // echo $form->field($model, 'ratingStar') ?>

    <?php // echo $form->field($model, 'offerExists') ?>

    <?php // echo $form->field($model, 'descrip') ?>

    <?php // echo $form->field($model, 'offerTitle') ?>

    <?php // echo $form->field($model, 'offerDescription') ?>

    <?php // echo $form->field($model, 'isPoolAvailable') ?>

    <?php // echo $form->field($model, 'isGymAvailable') ?>

    <?php // echo $form->field($model, 'isWifiAvailable') ?>

    <?php // echo $form->field($model, 'isVisaPaymentAvailable') ?>

    <?php // echo $form->field($model, 'isDiningInAvailable') ?>

    <?php // echo $form->field($model, 'accomadtionType') ?>

    <?php // echo $form->field($model, 'elgounaVoice') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'phoneNumber') ?>

    <?php // echo $form->field($model, 'info') ?>

    <?php // echo $form->field($model, 'facebookLink') ?>

    <?php // echo $form->field($model, 'twitterLink') ?>

    <?php // echo $form->field($model, 'instagramLink') ?>

    <?php // echo $form->field($model, 'youtubeLink') ?>

    <?php // echo $form->field($model, 'ord') ?>

    <?php // echo $form->field($model, 'hidden') ?>

    <?php // echo $form->field($model, 'category_id') ?>

    <?php // echo $form->field($model, 'price_type') ?>

    <?php // echo $form->field($model, 'popularity') ?>

    <?php // echo $form->field($model, 'location_id') ?>

    <?php // echo $form->field($model, 'place_type') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
