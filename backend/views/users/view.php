<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Users */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'userAuth:ntext',
            'name:ntext',
            'imageURL:ntext',
            'phoneNumber:ntext',
            'gender',
            'birthDate:ntext',
            'address:ntext',
            'email:ntext',
            'zipCode:ntext',
            'notificationsEnabled',
            'mapsEnabled',
            'elgounaPhone:ntext',
            'elgounaSMS:ntext',
            'elgounaemail:ntext',
            'fbId:ntext',
            'ehgzly_user_token',
            'ehgzly_user_id',
            'auth_reset_token',
        ],
    ]) ?>

</div>
