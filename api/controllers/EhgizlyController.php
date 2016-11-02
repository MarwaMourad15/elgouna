<?php

namespace api\controllers;

use linslin\yii2\curl;
use Yii;
use yii\filters\VerbFilter;
use backend\models\AppConfig;
use backend\models\Users;

/**
 * Class VenueController
 *
 * @package api\controllers
 */
class DiningController extends ApiController {
	public function behaviors() {
		return [ 
				'verbs' => [ 
						'class' => VerbFilter::className (),
						'actions' => [ 
								'event-list' => [ 
										'post' 
								],
								'update-order-status' => [ 
										'post' 
								] 
						] 
				] 
		];
	}
	public function actionUpdateOrderStatus() {
		$params = $this->parseRequest ();
		if (isset ( $params ['userId'] ) && isset ( $params ['OrderId'] )) {
			$all = [ ];
			$user = Users::find ()->where ( [ 
					'id' => $params ['userId'] 
			] )->one ();
			$all ['user'] = [ 
					'accessToken' => $user->ehgzly_user_token 
			];
			$header = [ 
					'appToken' => getAppToken (),
					'Content-Type' => 'application/json',
					'accessToken' => $user->ehgzly_user_token 
			];
			$params2 = [ 
					"OrderId" => $params ['OrderId'] 
			];
			$response = $this->CallCurl ( 'http://e7gezly.cloudapp.net/api/order/ChangeOrderStatus', 'post', $params2, $header );
			$order = new \stdClass ();
			$order->referenceCode = "{$response->body->refrenceCode}";
			$order->totalPayments = "{$response->body->totalPayments}";
			$order->orderStatus = "{$response->body->OrderStatus}";
			$order->orderStatusId = "qwertyufghjnmcvbnmgthj";
			$this->sendSuccessResponse2 ( 1, 200, $order );
		} else
			$this->sendFailedResponse ( 0, 400, 'Invalid_Parameters' );
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
			for($i = 0; $i < sizeof ( $response->body ); $i ++) {
				$categories = [ ];
				$links = [ ];
				$event = new \stdClass ();
				$event->id = "{$response->body[$i]->EventId}";
				$event->title = "{$response->body[$i]->EventTitle}";
				$event->description = "{$response->body[$i]->EventDescreption}";
				$event->phone = "{$response->body[$i]->EventPhoneNumber}";
				$event->longitude = "{$response->body[$i]->Eventlongtiude}";
				$event->latitude = "{$response->body[$i]->EventLatitude}";
				$event->startdate = "{$response->body[$i]->EventStartDate}";
				$event->enddate = "{$response->body[$i]->EventEndDate}";
				$event->eventLocation = "{$response->body[$i]->EventLocation}";
				$event->mainPhotoUrl = "{$response->body[$i]->EventImageUrl}";
				$event->siteUrl = "{$response->body[$i]->SiteUrl}";
				$event->facebookLink = "{$response->body[$i]->OtherLinks[0]}";
				$event->twitterLink = "{$response->body[$i]->OtherLinks[1]}";
				$event->instagramLink = "{$response->body[$i]->OtherLinks[2]}";
				if (sizeof ( $response->body [$i]->EventCategory ) != 0) {
					$event->isFree = false;
				} else {
					$event->isFree = true;
				}
				// $event->PageSize = 5;
				// $event->PageNumber = $obj->PageNumber;
				// $event->OrderBy = "EventTitle";
				for($j = 0; $j < sizeof ( $response->body [$i]->EventCategory ); $j ++) {
					$category = new \stdClass ();
					$category->id = "{$response->body[$i]->EventCategory[$j]->CategoryId}";
					$category->name = "{$response->body[$i]->EventCategory[$j]->CategoryName}";
					$category->price = $response->body [$i]->EventCategory [$j]->CategoryPrice;
					$category->numberOfTickets = $response->body [$i]->EventCategory [$j]->NumberOfTickets;
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
		
		/*
		 * if($response->error)
		 * {
		 * print_r($response->error);
		 * die;
		 * }
		 */
		return json_decode ( $response, true );
	}
}
