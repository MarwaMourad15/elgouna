<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\BeachReview */

$this->title = Yii::t('app', 'Create Beach Review');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Beach Reviews'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="beach-review-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
