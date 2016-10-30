<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Users */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'userAuth')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'imageURL')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'phoneNumber')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'gender')->textInput() ?>

    <?= $form->field($model, 'birthDate')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'email')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'zipCode')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'notificationsEnabled')->textInput() ?>

    <?= $form->field($model, 'mapsEnabled')->textInput() ?>

    <?= $form->field($model, 'elgounaPhone')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'elgounaSMS')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'elgounaemail')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'fbId')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'ehgzly_user_token')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ehgzly_user_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'auth_reset_token')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
