<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Beaches */

$this->title = Yii::t('app', 'Create Beaches');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Beaches'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="beaches-create">

    <div class="panel panel-primary">
        <div class="panel-heading"><h5><?= Html::encode($this->title) ?></h5></div>
        <div class="panel-body">

        <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>
</div>
