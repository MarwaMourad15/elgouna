<?php

namespace backend\controllers;

use backend\models\BeachesImg;
use backend\models\HotelsImg;
use backend\models\Services;
use backend\models\VenuesImg;
use Yii;
use backend\models\Beaches;
use backend\models\BeachesSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BeachesController implements the CRUD actions for Beaches model.
 */
class BeachesController extends Controller {
	/**
	 * @inheritdoc
	 */
	public function behaviors() {
		return [ 
				'verbs' => [ 
						'class' => VerbFilter::className (),
						'actions' => [ 
								'delete' => [ 
										'POST' 
								] 
						] 
				],
				'access' => [ 
						'class' => AccessControl::className (),
						'rules' => [ 
								[ 
										'allow' => true,
										'roles' => [ 
												'@' 
										] 
								] 
						] 
				] 
		];
	}
	
	/**
	 * Lists all Beaches models.
	 *
	 * @return mixed
	 */
	public function actionIndex() {
		$searchModel = new BeachesSearch ();
		$dataProvider = $searchModel->search ( Yii::$app->request->queryParams );
		
		return $this->render ( 'index', [ 
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider 
		] );
	}
	
	/**
	 * Displays a single Beaches model.
	 *
	 * @param integer $id        	
	 * @return mixed
	 */
	public function actionView($id) {
		return $this->render ( 'view', [ 
				'model' => $this->findModel ( $id ) 
		] );
	}
	
	/**
	 * Creates a new Beaches model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 *
	 * @return mixed
	 */
	public function actionCreate() {
		$model = new Beaches ();
		
		if ($model->load ( Yii::$app->request->post () ) && $model->save ()) {
			
			// / upload images
			$image = UploadedFile::getInstancesByName ( 'images' );
			// print_r($image);
			$msg = 'uploaded ';
			foreach ( $image as $img ) {
				$msg .= $img->name;
				$beachImage = new BeachesImg ();
				$beachImage->beach_id = $id;
				$msg .= $img->name;
				$uploadedName = explode ( ".", $img->name );
				$ext = end ( $uploadedName );
				$rand = uniqid ();
				$imageName = time () . $rand . '.' . $ext;
				$imageTmpName = $imageName;
				$path = 'images/beaches/';
				if (! empty ( $imageName )) {
					$beachImage->img = $path . $imageName;
				}
				if ($beachImage->save ()) {
					$finalPath = dirname ( dirname ( __DIR__ ) ) . $path . $imageName;
					if ($img->saveAs ( $finalPath )) {
						Yii::$app->getSession ()->setFlash ( 'success', 'Item has been Updated successfully' );
						// return json_encode((object)NULL);
					} else {
						Yii::$app->getSession ()->setFlash ( 'success', 'An Error Occurred while uploading image. Please try again!' );
						// return json_encode(['error' => 'An Error Occurred. Please try again!']);
					}
				}
			}
			
			return $this->redirect ( [ 
					'view',
					'id' => $model->id 
			] );
		} else {
			return $this->render ( 'create', [ 
					'model' => $model 
			] );
		}
	}
	
	/**
	 * Updates an existing Beaches model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 *
	 * @param integer $id        	
	 * @return mixed
	 */
	public function actionUpdate($id) {
		$model = $this->findModel ( $id );
		
		if ($model->load ( Yii::$app->request->post () ) && $model->save ()) {
			return $this->redirect ( [ 
					'view',
					'id' => $model->id 
			] );
		} else {
			return $this->render ( 'update', [ 
					'model' => $model 
			] );
		}
	}
	
	/**
	 * Deletes an existing Beaches model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 *
	 * @param integer $id        	
	 * @return mixed
	 */
	public function actionDelete($id) {
		$this->findModel ( $id )->delete ();
		
		return $this->redirect ( [ 
				'index' 
		] );
	}
	
	/**
	 * Finds the Beaches model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id        	
	 * @return Beaches the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id) {
		if (($model = Beaches::findOne ( $id )) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException ( 'The requested page does not exist.' );
		}
	}
	
	/*
	 * public function actionUpdateImagesB()
	 * {
	 * $beaches = BeachesImg::find()->all();;
	 * foreach ($beaches as $row) {
	 * echo $_img = $row['img'];
	 * echo '<br>';
	 * $img = 'images/beaches/'.$_img;
	 * echo $row->img = $img;
	 * echo '<br>';
	 * $row->save();
	 *
	 * }
	 * }
	 *
	 *
	 * public function actionUpdateImagesV()
	 * {
	 * $beaches = VenuesImg::find()->all();;
	 * foreach ($beaches as $row) {
	 * echo $_img = $row['img'];
	 * echo '<br>';
	 * $img = 'images/venues/'.$_img;
	 * echo $row->img = $img;
	 * echo '<br>';
	 * $row->save();
	 *
	 * }
	 * }
	 *
	 *
	 * public function actionUpdateImagesS()
	 * {
	 * $beaches = Services::find()->all();;
	 * foreach ($beaches as $row) {
	 * echo $_img = $row['img'];
	 * echo '<br>';
	 * $img = 'images/services/'.$_img;
	 * echo $row->img = $img;
	 * echo '<br>';
	 * $row->save();
	 *
	 * }
	 * }
	 *
	 *
	 * public function actionUpdateImagesH()
	 * {
	 * $beaches = HotelsImg::find()->all();;
	 * foreach ($beaches as $row) {
	 * echo $_img = $row['img'];
	 * echo '<br>';
	 * $img = 'images/hotels/'.$_img;
	 * echo $row->img = $img;
	 * echo '<br>';
	 * $row->save();
	 *
	 * }
	 * }
	 */
}
