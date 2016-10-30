<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\BeachCategory */

$this->title = Yii::t('app', 'Create Beach Category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Beach Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="beach-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
