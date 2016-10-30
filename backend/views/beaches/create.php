<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Beaches */

$this->title = Yii::t('app', 'Create Beaches');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Beaches'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="beaches-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
