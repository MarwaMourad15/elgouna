<?php

namespace backend\controllers;

use Yii;
use backend\models\Hotels;
use backend\models\HotelsSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\HotelsImg;
use yii\web\UploadedFile;

/**
 * HotelsController implements the CRUD actions for Hotels model.
 */
class HotelsController extends Controller {
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
	 * Lists all Hotels models.
	 *
	 * @return mixed
	 */
	public function actionIndex() {
		$searchModel = new HotelsSearch ();
		$dataProvider = $searchModel->search ( Yii::$app->request->queryParams );
		
		return $this->render ( 'index', [ 
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider 
		] );
	}
	
	/**
	 * Displays a single Hotels model.
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
	 * Creates a new Hotels model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 *
	 * @return mixed
	 */
	public function actionCreate() {
		$model = new Hotels ();
		
		if ($model->load ( Yii::$app->request->post () ) && $model->save ()) {
			// / upload images
			$image = UploadedFile::getInstances ( $model, 'images' );
			var_dump ( $image );
			die ();
			$msg = 'uploaded ';
			foreach ( $image as $img ) {
				$msg .= $img->name;
				$hotelImage = new HotelsImg ();
				$hotelImage->hotel_id = $id;
				$msg .= $img->name;
				$uploadedName = explode ( ".", $img->name );
				$ext = end ( $uploadedName );
				$rand = uniqid ();
				$imageName = time () . $rand . '.' . $ext;
				$imageTmpName = $imageName;
				$path = 'images/hotels/';
				if (! empty ( $imageName )) {
					$hotelImage->img = $path . $imageName;
				}
				if ($hotelImage->save ()) {
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
	 * Updates an existing Hotels model.
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
	 * Deletes an existing Hotels model.
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
	 * Finds the Hotels model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param integer $id        	
	 * @return Hotels the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id) {
		if (($model = Hotels::findOne ( $id )) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException ( 'The requested page does not exist.' );
		}
	}
}
