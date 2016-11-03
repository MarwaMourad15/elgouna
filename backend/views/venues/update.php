<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Venues */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Venues',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Venues'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="venues-update">

     <div class="panel panel-primary">
        <div class="panel-heading"><h5><?= Html::encode($this->title) ?></h5></div>
        <div class="panel-body">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>
</div>
