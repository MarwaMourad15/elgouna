<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Hotels;
use backend\models\Users;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\HotelReview */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hotel-review-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'hotel_id')->dropDownList(ArrayHelper::map( Hotels::find()->all(), 'id', 'name' ),[ 'prompt' => '' ])?>

    <?= $form->field($model, 'user_id')->dropDownList(ArrayHelper::map( Users::find()->all(), 'id', 'name' ),[ 'prompt' => '' ])?>

    <?= $form->field($model, 'review')->textarea(['rows' => 6])?>

    <?= $form->field($model, 'rating')->textInput()?>

    <?= $form->field($model, 'date')->textInput()?>

    <?= $form->field($model, 'approved')->textInput()?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
