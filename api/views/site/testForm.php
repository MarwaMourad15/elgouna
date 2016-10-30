<?php
/**
 * Created by PhpStorm.
 * User: Muhammed Fareed
 * Date: 7/19/2016
 * Time: 12:45 PM
 */
use yii\helpers\Html;
?>
<?=  Html::beginForm([''],'post',['id'=>'formTest'])?>
    <?= Html::dropDownList('action','',['register','activate','forgot','login'],[])?>
    <?= Html::textarea('params')?>
    <?= Html::submitButton('submit')?>
<?= Html::endForm()?>

