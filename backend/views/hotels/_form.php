<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model backend\models\Hotels */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hotels-form">

    <?php $form = ActiveForm::begin(['options' => ['encytype'=>'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textarea(['rows' => 6])?>

    <?= $form->field($model, 'location')->textarea(['rows' => 6])?>

    <?= $form->field($model, 'longitude')->textarea(['rows' => 6])?>

    <?= $form->field($model, 'latitude')->textarea(['rows' => 6])?>

    <?= $form->field($model, 'bookingLink')->textInput(['maxlength' => true])?>

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

    <?= $form->field($model, 'virtualTourLink')->textInput(['maxlength' => true])?>

    <?= $form->field($model, 'pid')->textInput()?>

    <?= $form->field($model, 'ord')->textInput()?>

    <?= $form->field($model, 'hidden')->textInput()?>
    
    <?= $form->field($model, 'images[]')->widget(FileInput::classname(), [
              'options' => ['multiple' => true,'accept' => 'image/*'],
               'pluginOptions'=>['allowedFileExtensions'=>['jpg','gif','png'],'showUpload' => false,],
          ]);   ?>
    
    
	<div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
