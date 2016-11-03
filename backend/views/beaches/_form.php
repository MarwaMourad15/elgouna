<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\BeachCategory;
use backend\models\Location;

/* @var $this yii\web\View */
/* @var $model backend\models\Beaches */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="beaches-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textarea(['rows' => 6])?>

    <?= $form->field($model, 'type')->textInput(['maxlength' => true])?>

    <?= $form->field($model, 'location')->textarea(['rows' => 6])?>

    <?= $form->field($model, 'longitude')->textarea(['rows' => 6])?>

    <?= $form->field($model, 'latitude')->textarea(['rows' => 6])?>

    <?= $form->field($model, 'reviewScore')->textInput()?>

    <?= $form->field($model, 'ratingStar')->textInput()?>

    <?= $form->field($model, 'offerExists')->textInput()?>

    <?= $form->field($model, 'descrip')->textarea(['rows' => 6])?>

    <?= $form->field($model, 'offerTitle')->textarea(['rows' => 6])?>

    <?= $form->field($model, 'offerDescription')->textarea(['rows' => 6])?>

    <?= $form->field($model, 'isPoolAvailable')->textInput()?>

    <?= $form->field($model, 'isGymAvailable')->textInput()?>

    <?= $form->field($model, 'isWifiAvailable')->textInput()?>

    <?= $form->field($model, 'isVisaPaymentAvailable')->textInput()?>

    <?= $form->field($model, 'isDiningInAvailable')->textInput()?>

    <?= $form->field($model, 'accomadtionType')->textarea(['rows' => 6])?>

    <?= $form->field($model, 'elgounaVoice')->textarea(['rows' => 6])?>

    <?= $form->field($model, 'email')->textarea(['rows' => 6])?>

    <?= $form->field($model, 'phoneNumber')->textarea(['rows' => 6])?>

    <?= $form->field($model, 'info')->textarea(['rows' => 6])?>

    <?= $form->field($model, 'facebookLink')->textarea(['rows' => 6])?>

    <?= $form->field($model, 'twitterLink')->textarea(['rows' => 6])?>

    <?= $form->field($model, 'instagramLink')->textarea(['rows' => 6])?>

    <?= $form->field($model, 'youtubeLink')->textarea(['rows' => 6])?>

    <?= $form->field($model, 'ord')->textInput()?>

    <?= $form->field($model, 'hidden')->textInput()?>

    <?= $form->field($model, 'category_id')->dropDownList(ArrayHelper::map( BeachCategory::find()->all(), 'id', 'name' ),[ 'prompt' => '' ])?>

    <?= $form->field($model, 'price_type')->textInput()?>

    <?= $form->field($model, 'popularity')->textInput()?>

    <?= $form->field($model, 'location_id')->dropDownList(ArrayHelper::map( Location::find()->all(), 'id', 'name' ),[ 'prompt' => '' ])?>

    <?= $form->field($model, 'place_type')->textInput()?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
