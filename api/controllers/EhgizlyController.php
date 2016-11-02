<?php

namespace api\controllers;

use linslin\yii2\curl;
use Yii;
use yii\filters\VerbFilter;
use backend\models\AppConfig;
use backend\models\Users;

/**
 * Class EhgizlyController
 *
 * @package api\controllers
 */
class EhgizlyController extends ApiController {
	public function behaviors() {
		return [ 
				'verbs' => [ 
						'class' => VerbFilter::className (),
						'actions' => [ 
								'event-list' => [ 
										'post' 
								] 
						] 
				] 
		];
	}
	public function actionEventList() {
		$params = $this->parseRequest ();
		if (isset ( $params ['PageNumber'] )) {
			$all = [ ];
			$params = [ 
					"PageSize" => 5,
					"PageNumber" => $params ['PageNumber'],
					"OrderBy" => "EventStartDate" 
			];
			$header = [ 
					'Content-Type' => 'application/json',
					'appToken' => $this->getAppToken () 
			];
			$response = $this->CallCurl ( "http://e7gezly.cloudapp.net/api/event/GetAllEvents", 'post', $params, $header );
			
			for($i = 0; $i < sizeof ( $response ); $i ++) {
				$categories = [ ];
				$links = [ ];
				$event = new \stdClass ();
				$event->id = $response [$i] ['EventId'];
				$event->title = $response [$i] ['EventTitle'];
				$event->description = $response [$i] ['EventDescreption'];
				$event->phone = $response [$i] ['EventPhoneNumber'];
				$event->longitude = $response [$i] ['Eventlongtiude'];
				$event->latitude = $response [$i] ['EventLatitude'];
				$event->startdate = $response [$i] ['EventStartDate'];
				$event->enddate = $response [$i] ['EventEndDate'];
				$event->eventLocation = $response [$i] ['EventLocation'];
				$event->mainPhotoUrl = $response [$i] ['EventImageUrl'];
				$event->siteUrl = $response [$i] ['SiteUrl'];
				$event->facebookLink = $response [$i] ['OtherLinks'] [0];
				$event->twitterLink = $response [$i] ['OtherLinks'] [1];
				$event->instagramLink = $response [$i] ['OtherLinks'] [2];
				if (sizeof ( $response [$i] ['EventCategory'] ) != 0) {
					$event->isFree = false;
				} else {
					$event->isFree = true;
				}
				// $event->PageSize = 5;
				// $event->PageNumber = $obj->PageNumber;
				// $event->OrderBy = "EventTitle";
				for($j = 0; $j < sizeof ( $response [$i] ['EventCategory'] ); $j ++) {
					$category = new \stdClass ();
					$category->id = $response [$i] ['EventCategory'] [$j] ['CategoryId'];
					$category->name = $response [$i] ['EventCategory'] [$j] ['CategoryName'];
					$category->price = $response [$i] ['EventCategory'] [$j] ['CategoryPrice'];
					$category->numberOfTickets = $response [$i] ['EventCategory'] [$j] ['NumberOfTickets'];
					$categories [$j] = $category;
				}
				$event->categories = $categories;
				$all [$i] = $event;
			}
			$this->sendSuccessResponse2 ( 1, 200, $all );
		} else
			$this->sendFailedResponse ( 0, 400, 'Invalid_Parameters' );
	}
	private function updateAppToken() {
		$appTokenKey = "E7gzlyAppToken";
		$params = [ 
				"App_Key" => "862c687c-59be-48d8-ab88-cb94c330b714",
				"App_secret" => "862c687c-59be-48d8-ab88-cb94c330b714" 
		];
		$header = [ 
				'Content-Type' => 'application/json' 
		];
		$response = $this->CallCurl ( "http://e7gezly.cloudapp.net/api/AppSecurity/getapptoken/", 'post', $params, $header );
		$appConfig = AppConfig::find ()->where ( [ 
				'key' => $appTokenKey 
		] )->one ();
		if ($appConfig == null) {
			$appConfig = new AppConfig ();
			$appConfig->key = $appTokenKey;
			$appConfig->value = $response->body->access_token;
			$appConfig->save ();
		} else {
			$appConfig->value = $response->body->access_token;
			$appConfig->update ();
		}
		return $appConfig;
	}
	private function getAppToken() {
		$appTokenKey = "E7gzlyAppToken";
		$appConfig = AppConfig::find ()->where ( [ 
				'key' => $appTokenKey 
		] )->one ();
		if ($appConfig == null) {
			$appConfig = $this->updateAppToken ();
		}
		return $appConfig->value;
	}
	private function repeatRequest($code = 0) {
		if ($code != 200) {
			$this->getAppToken ();
			return true;
		} else {
			return false;
		}
	}
	private function CallCurl($url, $method, $params, $header) {
		$curl = new curl\Curl ();
		if ($method == 'get') {
			$response = $curl->get ( $url );
		}
		if ($method == 'post') {
			$curl->setOption ( CURLOPT_HEADER, http_build_query ( $header ) );
			$response = $curl->setOption ( CURLOPT_POSTFIELDS, http_build_query ( $params ) )->post ( $url );
		}
		return json_decode ( $response, true );
	}
}
