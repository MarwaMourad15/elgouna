<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "hotels".
 *
 * @property integer $id
 * @property string $name
 * @property string $location
 * @property string $longitude
 * @property string $latitude
 * @property string $bookingLink
 * @property double $reviewScore
 * @property integer $ratingStar
 * @property integer $offerExists
 * @property string $descrip
 * @property string $offerTitle
 * @property string $offerDescription
 * @property integer $isPoolAvailable
 * @property integer $isGymAvailable
 * @property integer $isWifiAvailable
 * @property integer $isVisaPaymentAvailable
 * @property integer $isDiningInAvailable
 * @property string $accomadtionType
 * @property string $elgounaVoice
 * @property string $email
 * @property string $phoneNumber
 * @property string $info
 * @property string $facebookLink
 * @property string $twitterLink
 * @property string $instagramLink
 * @property string $youtubeLink
 * @property string $virtualTourLink
 * @property integer $pid
 * @property integer $ord
 * @property integer $hidden
 */
class Hotels extends \yii\db\ActiveRecord {
	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return 'hotels';
	}
	
	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
				// /[['name', 'location', 'longitude', 'latitude', 'reviewScore', 'ratingStar', 'offerExists', 'descrip', 'offerTitle', 'offerDescription', 'isPoolAvailable', 'isGymAvailable', 'isWifiAvailable', 'isVisaPaymentAvailable', 'isDiningInAvailable', 'accomadtionType', 'elgounaVoice', 'email', 'phoneNumber', 'info', 'facebookLink', 'twitterLink', 'instagramLink', 'youtubeLink', 'virtualTourLink', 'pid', 'ord', 'hidden'], 'required'],
				[ 
						[ 
								'name',
								'location',
								'longitude',
								'latitude',
								'descrip',
								'offerTitle',
								'offerDescription',
								'accomadtionType',
								'elgounaVoice',
								'email',
								'phoneNumber',
								'info',
								'facebookLink',
								'twitterLink',
								'instagramLink',
								'youtubeLink' 
						],
						'string' 
				],
				[ 
						[ 
								'reviewScore' 
						],
						'number' 
				],
				[ 
						[ 
								'ratingStar',
								'offerExists',
								'isPoolAvailable',
								'isGymAvailable',
								'isWifiAvailable',
								'isVisaPaymentAvailable',
								'isDiningInAvailable',
								'pid',
								'ord',
								'hidden' 
						],
						'integer' 
				],
				[ 
						[ 
								'bookingLink' 
						],
						'string',
						'max' => 1000 
				],
				[ 
						[ 
								'virtualTourLink' 
						],
						'string',
						'max' => 300 
				] 
		];
	}
	
	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [ 
				'id' => Yii::t ( 'app', 'ID' ),
				'name' => Yii::t ( 'app', 'Name' ),
				'location' => Yii::t ( 'app', 'Location' ),
				'longitude' => Yii::t ( 'app', 'Longitude' ),
				'latitude' => Yii::t ( 'app', 'Latitude' ),
				'bookingLink' => Yii::t ( 'app', 'Booking Link' ),
				'reviewScore' => Yii::t ( 'app', 'Review Score' ),
				'ratingStar' => Yii::t ( 'app', 'Rating Star' ),
				'offerExists' => Yii::t ( 'app', 'Offer Exists' ),
				'descrip' => Yii::t ( 'app', 'Descrip' ),
				'offerTitle' => Yii::t ( 'app', 'Offer Title' ),
				'offerDescription' => Yii::t ( 'app', 'Offer Description' ),
				'isPoolAvailable' => Yii::t ( 'app', 'Is Pool Available' ),
				'isGymAvailable' => Yii::t ( 'app', 'Is Gym Available' ),
				'isWifiAvailable' => Yii::t ( 'app', 'Is Wifi Available' ),
				'isVisaPaymentAvailable' => Yii::t ( 'app', 'Is Visa Payment Available' ),
				'isDiningInAvailable' => Yii::t ( 'app', 'Is Dining In Available' ),
				'accomadtionType' => Yii::t ( 'app', 'Accomadtion Type' ),
				'elgounaVoice' => Yii::t ( 'app', 'Elgouna Voice' ),
				'email' => Yii::t ( 'app', 'Email' ),
				'phoneNumber' => Yii::t ( 'app', 'Phone Number' ),
				'info' => Yii::t ( 'app', 'Info' ),
				'facebookLink' => Yii::t ( 'app', 'Facebook Link' ),
				'twitterLink' => Yii::t ( 'app', 'Twitter Link' ),
				'instagramLink' => Yii::t ( 'app', 'Instagram Link' ),
				'youtubeLink' => Yii::t ( 'app', 'Youtube Link' ),
				'virtualTourLink' => Yii::t ( 'app', 'Virtual Tour Link' ),
				'pid' => Yii::t ( 'app', 'Pid' ),
				'ord' => Yii::t ( 'app', 'Ord' ),
				'hidden' => Yii::t ( 'app', 'Hidden' ) 
		];
	}
	public static function getHotels() {
		return ArrayHelper::map ( self::find ()->all (), 'id', 'name' );
	}
}
