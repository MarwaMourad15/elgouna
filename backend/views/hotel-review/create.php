<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\HotelReview */

$this->title = Yii::t('app', 'Create Hotel Review');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Hotel Reviews'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hotel-review-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
