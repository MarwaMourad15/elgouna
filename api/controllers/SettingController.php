<?php

namespace api\controllers;

use backend\models\Location;
use backend\models\Settings;
use Yii;
use yii\filters\VerbFilter;
use backend\models\Contact;
use backend\models\Transportation;

/**
 * Class SettingController
 *
 * @package frontend\controllers
 */
class SettingController extends ApiController {
	public function behaviors() {
		return [ 
				'verbs' => [ 
						'class' => VerbFilter::className (),
						'actions' => [ 
								'settings' => [ 
										'get' 
								],
								'locations' => [ 
										'get' 
								],
								'upload-photo' => [ 
										'post' 
								],
								'contact' => [ 
										'post' 
								],
								'get-trans-types' => [ 
										'get' 
								] 
						] 
				] 
		];
	}
	public function actionGetTransTypes() {
		$all = [ ];
		$transTypes = Transportation::find ()->all ();
		foreach ( $transTypes as $transType ) {
			$transTypeObj = new \stdClass ();
			$transTypeObj->id = $transType->id;
			$transTypeObj->type = $transType->type;
			$transTypeObj->description = $transType->description;
			$transTypeObj->img = $transType->img;
			$all [] = $transTypeObj;
		}
		$this->sendSuccessResponse2 ( 1, 200, $all );
	}
	public function actionContact() {
		$params = $this->parseRequest ();
		if (isset ( $params ['name'] ) && isset ( $params ['email'] ) && isset ( $params ['phone'] ) && isset ( $params ['message'] )) {
			$json = [ ];
			$json ['status'] = 0;
			date_default_timezone_set ( 'Africa/Cairo' );
			$currentDate = date ( "Y-m-d H:i:s" );
			$sent = $this->sendContactMail ( $params ['name'], $params ['email'], $params ['phone'], $params ['message'] );
			if ($sent) {
				$contact = new Contact ();
				$contact->name = $params ['name'];
				$contact->email = $params ['email'];
				$contact->phone = $params ['phone'];
				$contact->msg = $params ['message'];
				$contact->date = $currentDate;
				if ($contact->save ()) {
					$json ['status'] = 1;
					$json ['msg'] = 'mail delivered and stored.';
				} else {
					$json ['msg'] = 'mail delivered but not stored.';
				}
			} else {
				$json ['msg'] = 'mail not delivered.';
			}
			$this->sendSuccessResponse2 ( 1, 200, $json );
		} else
			$this->sendFailedResponse ( 0, 400, 'Invalid_Parameters' );
	}
	public function actionSettings() {
		$setting = Settings::find ()->where ( 'id=:id', [ 
				':id' => 1 
		] )->one ();
		if ($setting) {
			$this->sendSuccessResponse2 ( 1, 200, [ 
					'bookingURL' => $this->stringVal ( $setting ['bookingURL'] ),
					'facebookURL' => $this->stringVal ( $setting ['facebookURL'] ),
					'elgounaURL' => $this->stringVal ( $setting ['elgounaURL'] ),
					'twitterURL' => $this->stringVal ( $setting ['twitterURL'] ),
					'youtubeURL' => $this->stringVal ( $setting ['youtubeURL'] ),
					'instagramURL' => $this->stringVal ( $setting ['instagramURL'] ),
					'snapchatURL' => $this->stringVal ( $setting ['snapchatURL'] ),
					'elgounaPhone' => $this->stringVal ( $setting ['elgounaPhone'] ),
					'elgounaSMS' => $this->stringVal ( $setting ['elgounaSMS'] ),
					'elgounaemail' => $this->stringVal ( $setting ['elgounaemail'] ),
					'paymobAPIKey' => $this->stringVal ( $setting ['paymobAPIKey'] ),
					'paymobSecretKey' => $this->stringVal ( $setting ['paymobSecretKey'] ),
					'paymobMerchantId' => $this->stringVal ( $setting ['paymobMerchantId'] ),
					'paymobSecureHash' => $this->stringVal ( $setting ['paymobSecureHash'] ),
					'about' => $this->stringVal ( $setting ['about'] ) 
			] );
		} else {
			$this->sendFailedResponse ( 0, 400, 'Something_Went_Wrong_Please_Try_Again_Later' );
		}
	}
	public function actionLocations() {
		$all = array ();
		$Locations = Location::find ()->orderBy ( [ 
				'ordering' => SORT_ASC 
		] )->all ();
		foreach ( $Locations as $loc ) {
			$response = [ 
					'id' => intval ( $loc->id ),
					'title' => $this->stringVal ( $loc->title ) 
			];
			$all [] = $response;
		}
		$this->sendSuccessResponse ( 1, 200, $all );
	}
	public function actionUploadPhoto() {
		$params = $this->parseRequest ();
		if (isset ( $params ['id'] ) && isset ( $params ['token'] ) && isset ( $params ['image'] ) && isset ( $params ['extension'] )) {
			if ($this->checkPatientToken ( $params ['id'], $params ['token'] )) {
				$ext = $params ['extension'];
				$img = $params ['image'];
				if (! $this->checkImageExtension ( $ext )) {
					$this->sendFailedResponse ( 0, 704, 'Invalid_Image_Extension' );
				} else {
					$response = $this->uploadPhoto ( $ext, $img, '/uploads' );
					if ($response ['code'] == 200) {
						$this->sendSuccessResponse ( 1, 200, [ 
								'url' => $response ['message'] 
						] );
					} else if ($response ['code'] == 400) {
						$this->sendFailedResponse ( 0, 400, $response ['message'] );
					}
				}
			} else {
				$this->sendFailedResponse ( 0, 400, 'Invalid_Token' );
			}
		} else {
			$this->sendFailedResponse ( 0, 400, 'Invalid_Parameters' );
		}
		/*
		 * define('UPLOAD_DIR', '../../uploads/');
		 * $img = str_replace('data:image/png;base64,', '', $img);
		 * $img = str_replace(' ', '+', $img);
		 * $data = base64_decode($img);
		 * $file = UPLOAD_DIR . uniqid() . '.png';
		 * $success = file_put_contents($file, $data);
		 * $file = str_replace("../..",Yii::$app->homeUrl,$file);
		 * if($success)
		 * $this->sendSuccessResponse(1,200,['url'=>$file]);
		 * else
		 * $this->sendFailedResponse(0,400,'Error_Uploading_Image');
		 */
	}
	private function sendContactMail($name, $email, $phone, $msg) {
		$to = 'hesham.saeed@appenza-studio.com';
		$subject = 'Elgouna App - Password Reset Verification';
		$message = "<table border='0' align='left' cellpadding='0' cellspacing='0'>
			<tr>
			<td valign='top'><strong>Name :</strong>" . $name . "
			</td>
			</tr>
			<tr>
			<td valign='top'><strong>E-mail :</strong>" . $email . "
			</td>
			</tr>
			<tr>
			<td valign='top'><strong>Phone :</strong>" . $phone . "
			</td>
			</tr>
			<tr>
			<td valign='top'><strong>Message :</strong>
			</td>
			</tr>
			<tr>
			<td align='left'>" . $msg . "
			</td>
			</tr>
			</table>";
		$headers = 'MIME-Version: 1.0' . "\r\n" . 'Content-Type: text/html; charset=UTF-8' . "\r\n" . 'From: info@elgouna.com' . "\r\n" . 'Reply-To: info@elgouna.com' . "\r\n" . 'X-Mailer: PHP/' . phpversion ();
		
		return mail ( $to, $subject, $message, $headers );
	}
}
