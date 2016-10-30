<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UsersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'userAuth') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'imageURL') ?>

    <?= $form->field($model, 'phoneNumber') ?>

    <?php // echo $form->field($model, 'gender') ?>

    <?php // echo $form->field($model, 'birthDate') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'zipCode') ?>

    <?php // echo $form->field($model, 'notificationsEnabled') ?>

    <?php // echo $form->field($model, 'mapsEnabled') ?>

    <?php // echo $form->field($model, 'elgounaPhone') ?>

    <?php // echo $form->field($model, 'elgounaSMS') ?>

    <?php // echo $form->field($model, 'elgounaemail') ?>

    <?php // echo $form->field($model, 'fbId') ?>

    <?php // echo $form->field($model, 'ehgzly_user_token') ?>

    <?php // echo $form->field($model, 'ehgzly_user_id') ?>

    <?php // echo $form->field($model, 'auth_reset_token') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
