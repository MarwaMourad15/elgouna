<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\HotelReview */

$this->title = Yii::t ( 'app', 'Create Hotel Review' );
$this->params ['breadcrumbs'] [] = [ 
		'label' => Yii::t ( 'app', 'Hotel Reviews' ),
		'url' => [ 
				'index' 
		] 
];
$this->params ['breadcrumbs'] [] = $this->title;
?>
<div class="hotel-review-create">

	<div class="panel panel-primary">
		<div class="panel-heading">
			<h5><?= Html::encode($this->title) ?></h5>
		</div>
		<div class="panel-body">

    <?=$this->render ( '_form', [ 'model' => $model ] )?>

</div>
	</div>
	</div>