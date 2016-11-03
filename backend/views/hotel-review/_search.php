<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Users;
use backend\models\Hotels

/* @var $this yii\web\View */
/* @var $model backend\models\HotelReviewSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hotel-review-search">

    <?php
				
				$form = ActiveForm::begin ( [ 
						'action' => [ 
								'index' 
						],
						'method' => 'get' 
				] );
				?>

    <?= $form->field($model, 'id')?>

    <?= $form->field($model, 'hotel_id')->dropDownList(ArrayHelper::map( Hotels::find()->all(), 'id', 'name' ),[ 'prompt' => '' ])?>

    <?= $form->field($model, 'user_id')->dropDownList(ArrayHelper::map( Users::find()->all(), 'id', 'name' ),[ 'prompt' => '' ])?>

    <?= $form->field($model, 'review')?>

    <?= $form->field($model, 'rating')?>

    <?php // echo $form->field($model, 'date') ?>

    <?php // echo $form->field($model, 'approved') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary'])?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default'])?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
