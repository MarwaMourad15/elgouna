<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use mihaildev\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model backend\models\Settings */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="settings-form">

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
        'options'=>['enctype'=>'multipart/form-data' ]
    ]); ?>


    <?= $form->field($model, 'bookingURL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'facebookURL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'elgounaURL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'twitterURL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'youtubeURL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'instagramURL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'snapchatURL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'elgounaPhone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'elgounaSMS')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'elgounaemail')->textInput(['maxlength' => true]) ?>

    <?/*= $form->field($model, 'about')->textarea(['rows' => 6]) */?>
    <? //= $form->field($model, 'description')->textarea(['rows' => 6])
    echo $form->field($model, 'about')->widget(CKEditor::className(),[
        'editorOptions' => [
            'preset' => 'full',
            'inline' => false,
        ],
    ]);
    ?>

    <?= $form->field($model, 'paymobAPIKey')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'paymobSecretKey')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'paymobMerchantId')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'paymobSecureHash')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <div class="control-label col-sm-3"></div>
        <div class="col-sm-8">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>