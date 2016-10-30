<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Weather */

$this->title = Yii::t('app', 'Create Weather');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Weathers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="weather-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
