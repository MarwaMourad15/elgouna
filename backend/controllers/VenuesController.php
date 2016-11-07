<?php

namespace backend\controllers;

use Yii;
use backend\models\Venues;
use backend\models\VenuesSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\VenuesImg;

/**
 * VenuesController implements the CRUD actions for Venues model.
 */
class VenuesController extends Controller {
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
	 * Lists all Venues models.
	 * 
	 * @return mixed
	 */
	public function actionIndex($type) {
		$searchModel = new VenuesSearch ();
		$searchModel->category_type = $type;
		$dataProvider = $searchModel->search ( Yii::$app->request->queryParams );
		
		return $this->render ( 'index', [ 
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider 
		] );
	}
	
	/**
	 * Displays a single Venues model.
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
	 * Creates a new Venues model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * 
	 * @return mixed
	 */
	public function actionCreate() {
		$model = new Venues ();
		
		if ($model->load ( Yii::$app->request->post () ) && $model->save ()) {
			// / upload images
			$image = UploadedFile::getInstancesByName ( 'images' );
			// print_r($image);
			$msg = 'uploaded ';
			foreach ( $image as $img ) {
				$msg .= $img->name;
				$venuesImage = new VenuesImg ();
				$venuesImage->venue_id = $id;
				$msg .= $img->name;
				$uploadedName = explode ( ".", $img->name );
				$ext = end ( $uploadedName );
				$rand = uniqid ();
				$imageName = time () . $rand . '.' . $ext;
				$imageTmpName = $imageName;
				$path = 'images/venues/';
				if (! empty ( $imageName )) {
					$venuesImage->img = $path . $imageName;
				}
				if ($venuesImage->save ()) {
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
	 * Updates an existing Venues model.
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
	 * Deletes an existing Venues model.
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
	 * Finds the Venues model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * 
	 * @param integer $id        	
	 * @return Venues the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id) {
		if (($model = Venues::findOne ( $id )) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException ( 'The requested page does not exist.' );
		}
	}
}
