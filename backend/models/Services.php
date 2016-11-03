<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "services".
 *
 * @property integer $id
 * @property string $title
 * @property string $img
 * @property integer $ord
 * @property integer $hidden
 */
class Services extends \yii\db\ActiveRecord {
	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'services';
	}
	
	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [ 
				[ 
						[ 
								'title',
								'img',
								'ord',
								'hidden' 
						],
						'required' 
				],
				[ 
						[ 
								'title',
								'img' 
						],
						'string' 
				],
				[ 
						[ 
								'ord',
								'hidden' 
						],
						'integer' 
				] 
		];
	}
	
	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [ 
				'id' => Yii::t ( 'app', 'ID' ),
				'title' => Yii::t ( 'app', 'Title' ),
				'img' => Yii::t ( 'app', 'Img' ),
				'ord' => Yii::t ( 'app', 'Ord' ),
				'hidden' => Yii::t ( 'app', 'Hidden' ) 
		];
	}
	public static function getServices() {
		return ArrayHelper::map ( self::find ()->all (), 'id', 'name' );
	}
}
