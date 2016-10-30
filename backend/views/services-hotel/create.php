<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ServicesHotel */

$this->title = Yii::t('app', 'Create Services Hotel');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Services Hotels'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="services-hotel-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
