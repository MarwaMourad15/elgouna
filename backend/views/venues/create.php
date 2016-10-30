<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Venues */

$this->title = Yii::t('app', 'Create Venues');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Venues'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="venues-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
