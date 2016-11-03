<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\VenueCategory */

$this->title = Yii::t('app', 'Create Venue Category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Venue Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="venue-category-create">

    <div class="panel panel-primary">
        <div class="panel-heading"><h5><?= Html::encode($this->title) ?></h5></div>
        <div class="panel-body">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>
</div>