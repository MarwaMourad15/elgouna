<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\widgets\FileInput;
use backend\models\BeachCategory;
use backend\models\Location;

use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model backend\models\Beaches */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="beaches-form">

    <?php $form = ActiveForm::begin(['layout'=>'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
            'horizontalCssClasses' => [
                'label' => 'col-sm-3',
                'offset' => 'col-sm-offset-4',
                'wrapper' => 'col-sm-8',
                'error' => '',
                'hint' => '',
            ],
        ],
        'options'=>['enctype'=>'multipart/form-data']
    ]); ?>

    <?= $form->field($model, 'name')->textInput()?>

    <?= $form->field($model, 'type')->hiddenInput(['value' => 'Things'])?>

    <?= $form->field($model, 'location')->textInput()?>

    <?= $form->field($model, 'longitude')->textInput(['rows' => 6])?>

    <?= $form->field($model, 'latitude')->textInput(['rows' => 6])?>

    <?= $form->field($model, 'reviewScore')->textInput()?>

    <?= $form->field($model, 'ratingStar')->textInput()?>

    <?= $form->field($model, 'offerExists')->textInput()?>

    <?= $form->field($model, 'descrip')->textarea(['rows' => 6])?>

    <?= $form->field($model, 'offerTitle')->textInput(['rows' => 6])?>

    <?= $form->field($model, 'offerDescription')->textarea(['rows' => 6])?>

    <?= $form->field($model, 'isPoolAvailable')->textInput()?>

    <?= $form->field($model, 'isGymAvailable')->textInput()?>

    <?= $form->field($model, 'isWifiAvailable')->textInput()?>

    <?= $form->field($model, 'isVisaPaymentAvailable')->textInput()?>

    <?= $form->field($model, 'isDiningInAvailable')->textInput()?>

    <?= $form->field($model, 'accomadtionType')->textarea(['rows' => 6])?>

    <?= $form->field($model, 'elgounaVoice')->textarea(['rows' => 6])?>

    <?= $form->field($model, 'email')->textInput(['rows' => 6])?>

    <?= $form->field($model, 'phoneNumber')->textInput(['rows' => 6])?>

    <?= $form->field($model, 'info')->textInput(['rows' => 6])?>

    <?= $form->field($model, 'facebookLink')->textInput(['rows' => 6])?>

    <?= $form->field($model, 'twitterLink')->textInput(['rows' => 6])?>

    <?= $form->field($model, 'instagramLink')->textInput(['rows' => 6])?>

    <?= $form->field($model, 'youtubeLink')->textInput(['rows' => 6])?>

    <?= $form->field($model, 'ord')->textInput()?>

    <?= $form->field($model, 'hidden')->textInput()?>

    <?= $form->field($model, 'category_id')->dropDownList(ArrayHelper::map( BeachCategory::find()->all(), 'id', 'title' ),[ 'prompt' => '' ])?>

    <?= $form->field($model, 'price_type')->textInput()?>

    <?= $form->field($model, 'popularity')->textInput()?>

    <?= $form->field($model, 'location_id')->dropDownList(ArrayHelper::map( Location::find()->all(), 'id', 'title' ),[ 'prompt' => '' ])?>

    <?= $form->field($model, 'place_type')->textInput()?>


    <div class="form-group">
        <div class="control-label col-sm-3">Upload Images</div>
        <div class="col-sm-8">
    <?= FileInput::widget(['name'=>'result[]',
        'options' => ['multiple' => true , 'accept' => '/*'],
        'pluginOptions' => ['previewFileType' => 'any', 'showUpload'=>false ,
        ],
    ])?>
        </div>
    </div>

    <div class="form-group">
        <div class="control-label col-sm-3"></div>
        <div class="col-sm-8">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>