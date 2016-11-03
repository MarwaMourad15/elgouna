<?php

namespace api\controllers;

use backend\models\HotelFilter;
use backend\models\Services;
use backend\models\Hotels;
use backend\models\ServicesHotel;
use backend\models\RateRange;
use backend\models\UserHotelLike;
use backend\models\HotelsImg;
use backend\models\Users;
use backend\models\HotelReview;
use Yii;
use yii\filters\VerbFilter;

/**
 * Class HotelController
 *
 * @package api\controllers
 */
class HotelController extends ApiController {
	public function behaviors() {
		return [ 
				'verbs' => [ 
						'class' => VerbFilter::className (),
						'actions' => [ 
								'list-hotels' => [ 
										'post' 
								],
								'hotel-reviews' => [ 
										'post' 
								],
								'like-hotel' => [ 
										'post' 
								],
								'submit-review' => [ 
										'post' 
								],
								'hotel-filter' => [ 
										'post' 
								],
								'hotel-services' => [ 
										'get' 
								] 
						] 
				] 
		];
	}
	public function actionHotelReviews() {
		$params = $this->parseRequest ();
		if (isset ( $params ['hotelId'] ) && isset ( $params ['lastId'] )) {
			$limit = "20";
			$start = $params ['lastId'];
			$count = $params ['lastId'];
			$reviewPro = 0;
			$all = [ ];
			$all ['reviews'] = [ ];
			if ($params ['lastId'] == 0) {
				$hotel = Hotels::find ()->where ( [ 
						'id' => $params ['hotelId'],
						'hidden' => 1 
				] )->one ();
				if ($hotel->id != 0) {
					$reviewsData = file_get_contents ( 'http://connect.reviewpro.com/v1/lodging/review/published?pid=' . $hotel->id . '&api_key=3xr4g6us6xmf5xq6abz84kbh5u3b9vght2xa29pd&sig=b396f6a3bb4e98c9ebe1e56e6518afa40700344456937ea1d21d6c142507ec3e' );
					$reviewsData = json_decode ( $reviewsData );
					$rr = 0;
					foreach ( $reviewsData->productReviews as $s => $x ) {
						foreach ( $x->reviews as $n => $m ) {
							$reviewPro ++;
							$userData = new \stdClass ();
							$userData->username = $m->author->name;
							$userData->imgURL = "";
							$reviewDate = gmdate ( "d-m-Y", $m->publishDate );
							$rating = ($m->ratings->OVERALL->value / $m->ratings->OVERALL->outOf) * 5;
							// var_dump($m);
							$all ['reviews'] [] = array (
									"recordId" => $reviewPro,
									"id" => "",
									"review" => $m->text,
									"rating" => $rating,
									"user" => $userData,
									"date" => $reviewDate 
							);
						}
					}
				}
			}
			$hotelReviews = HotelReview::find ()->where ( [ 
					'hotel_id' => $params ['hotelId'] 
			] )->where ( [ 
					'approved' => 1 
			] )->orderBy ( 'date asc' )->offset ( $start )->limit ( $limit )->all ();
			foreach ( $hotelReviews as $hotelReview ) {
				$count ++;
				$user = Users::find ()->where ( [ 
						'id' => $hotelReview->user_id 
				] )->one ();
				if ($user->imageURL != '') {
					$imgURL = $user->imageURL;
				} else {
					$imgURL = '';
				}
				$user = array (
						"username" => $user->name,
						"imgURL" => $imgURL 
				);
				$all ['reviews'] [] = [ 
						"recordId" => $count,
						"id" => $hotelReview->id,
						"review" => $hotelReview->review,
						"rating" => $hotelReview->rating,
						"user" => $user,
						"date" => $hotelReview->date 
				];
			}
			$this->sendSuccessResponse2 ( 1, 200, $all );
		} else
			$this->sendFailedResponse ( 0, 400, 'Invalid_Parameters' );
	}
	public function actionLikeHotel() {
		$params = $this->parseRequest ();
		$currentDate = date ( "Y-m-d H:i:s" );
		$all = [ ];
		if (isset ( $params ['userId'] ) && isset ( $params ['hotelId'] )) {
			$userLike = UserHotelLike::find ()->where ( [ 
					'user_id' => $params ['userId'],
					'hotel_id' => $params ['hotelId'] 
			] )->one ();
			if ($userLike == null) {
				$userLike = new UserHotelLike ();
				$userLike->date = $currentDate;
				$userLike->user_id = $params ['userId'];
				$userLike->hotel_id = $params ['hotelId'];
				$userLike->save ();
			}
			$all ['status'] = 1;
			$this->sendSuccessResponse2 ( 1, 200, $all );
		} else
			$this->sendFailedResponse ( 0, 400, 'Invalid_Parameters' );
	}
	public function actionSubmitReview() {
		$all = [ ];
		$params = $this->parseRequest ();
		if (isset ( $params ['userId'] ) && isset ( $params ['hotelId'] ) && isset ( $params ['rating'] ) && isset ( $params ['review'] )) {
			$currentDate = date ( "Y-m-d H:i:s" );
			$avgRate = 0;
			$review = new HotelReview ();
			$review->user_id = $params ['userId'];
			$review->hotel_id = $params ['hotelId'];
			$review->rating = intval ( $params ['rating'] );
			$review->date = $currentDate;
			$review->review = $params ['review'];
			$review->approved = 0;
			$review->save ();
			$hotelReview = HotelReview::find ()->where ( [ 
					'hotel_id' => $params ['hotelId'],
					'approved' => 1 
			] );
			$ratingSum = $hotelReview->sum ( 'rating' );
			$ratingCount = $hotelReview->count ();
			if ($ratingCount > 0) {
				$avgRate = $ratingSum / $ratingCount;
			}
			$avgRate = number_format ( $avgRate, 1 );
			$hotel = Hotels::find ()->where ( [ 
					'id' => intval ( $params ['hotelId'] ) 
			] )->one ();
			$hotel->reviewScore = $avgRate;
			if ($hotel->update () !== false)
				$all ['status'] = 1;
			else
				$all ['status'] = 0;
			$this->sendSuccessResponse2 ( 1, 200, $all );
		} else
			$this->sendFailedResponse ( 0, 400, 'Invalid_Parameters' );
	}
	public function actionHotelFilter() {
		$params = $this->parseRequest ();
		if (isset ( $params ['lastId'] )) {
			$all = [ ];
			$all ['hotels'] = [ ];
			$hotels = Hotels::find ()->where ( [ 
					'hidden' => 1 
			] );
			if (isset ( $params ['keyword'] ) && $params ['keyword'] != "") {
				$hotels->andWhere ( [ 
						'like',
						'name',
						$params ['keyword'] 
				] );
			}
			if (isset ( $params ['ratingStar'] ) && $params ['ratingStar'] != "" && intval ( $params ['ratingStar'] ) > 0) {
				$hotels->andWhere ( [ 
						'ratingStar' => intval ( $params ['ratingStar'] ) 
				] );
			}
			if (isset ( $params ['servicesIds'] ) && $params ['servicesIds'] != "") {
				// $hotelServices = ServicesHotel::find ()->where ( [ 'in',
				// 'service_id', $params ['servicesIds']
				// ] )->groupBy ( 'hotel_id' )->all ();
				$hotelServices = ServicesHotel::findBySql ( 'select * from `services_hotel` where `service_id` in (' . $params ['servicesIds'] . ') group by `hotel_id`' )->all ();
				$ids = [ ];
				foreach ( $hotelServices as $hotelService ) {
					$ids [] = $hotelService->hotel_id;
				}
				if (sizeof ( $ids ) > 0) {
					$hotels->andWhere ( [ 
							'id' => $ids 
					] );
				}
			}
			$hotels = $hotels->orderBy ( 'ord asc' )->all ();
			
			$count = $params ['lastId'];
			foreach ( $hotels as $hotel ) {
				$isLiked = 0;
				$rateRange = RateRange::find ()->where ( [ 
						'<=',
						'start',
						$hotel->reviewScore 
				] )->andWhere ( [ 
						'>',
						'end',
						$hotel->reviewScore 
				] )->one ();
				if ($rateRange->title == 'Poor') {
					$reviewScoreFinal = "--";
				} else {
					$reviewScoreFinal = $rateRange->title . " (" . $hotel->reviewScore . ")";
				}
				if ($params ['userId'] != "") {
					$userLike = UserHotelLike::find ()->where ( [ 
							'user_id' => $params ['userId'] 
					] )->where ( [ 
							'hotel_id' => $hotel->id 
					] )->count ();
					if ($userLike > 0)
						$isLiked = 1;
				}
				$hotelImages = HotelsImg::find ()->where ( [ 
						'hotel_id' => $hotel->id 
				] )->all ();
				$img = array ();
				foreach ( $hotelImages as $hotelImage ) {
					$img [] = $hotelImage->img;
				}
				$hotelServices = Services::find ()->join ( 'JOIN', 'services_hotel', 'services_hotel.service_id = services.id' )->where ( [ 
						'services_hotel.hotel_id' => $hotel->id 
				] )->all ();
				$services = [ ];
				foreach ( $hotelServices as $hotelService ) {
					$services [] = [ 
							"id" => $hotelService->id,
							"title" => $hotelService->title,
							"imageURL" => $hotelService->img 
					];
				}
				$count ++;
				$all ['hotels'] [] = [ 
						"hotelId" => $hotel->id,
						"name" => $hotel->name,
						"location" => $hotel->location,
						"longitude" => $hotel->longitude,
						"latitude" => $hotel->latitude,
						"reviewScore" => $reviewScoreFinal,
						"ratingStar" => $hotel->ratingStar,
						"offerExists" => $hotel->offerExists,
						"isLiked" => $isLiked,
						"gallery" => $img,
						"descrip" => $hotel->descrip,
						"offerTitle" => $hotel->offerTitle,
						"offerDescription" => $hotel->offerDescription,
						"services" => $services,
						"accomadtionType" => $hotel->accomadtionType,
						"elgounaVoice" => $hotel->elgounaVoice,
						"email" => $hotel->email,
						"phoneNumber" => $hotel->phoneNumber,
						"info" => $hotel->info,
						"facebookLink" => $hotel->facebookLink,
						"twitterLink" => $hotel->twitterLink,
						"instagramLink" => $hotel->instagramLink,
						"youtubeLink" => $hotel->youtubeLink 
				];
			}
			$this->sendSuccessResponse2 ( 1, 200, $all );
		} else
			$this->sendFailedResponse ( 0, 400, 'Invalid_Parameters' );
	}
	public function actionHotelServices() {
		$all = [ ];
		$all ['services'] = [ ];
		$services = Services::find ()->orderBy ( 'ord asc' )->all ();
		foreach ( $services as $service ) {
			$all ['services'] [] = [ 
					'id' => intval ( $service->id ),
					'title' => $service->title,
					'imageURL' => $service->img 
			];
		}
		$this->sendSuccessResponse2 ( 1, 200, $all );
	}
	public function actionListHotels() {
		$params = $this->parseRequest ();
		if (isset ( $params ['lastId'] )) {
			$query = Hotels::find ()->where ( [ 
					'hidden' => 1 
			] )->limit ( 20 );
			$query->offset ( $params ['lastId'] );
			
			$hotelFilter = null;
			if ($params ['filterId'] != "") {
				$hotelFilter = HotelFilter::find ()->andWhere ( [ 
						'id' => $params ['filterId'] 
				] )->one ();
			}
			$start = 0;
			
			if (isset ( $params ['query'] ) && $params ['query'] != "") {
				$query->andWhere ( [ 
						'like',
						'name',
						$params ['query'] 
				] );
			}
			if ($hotelFilter != null) {
				$query->orderBy ( substr ( $hotelFilter->query, 9 ) );
			} else {
				$query->orderBy ( 'ratingStar desc' );
			}
			
			$count = $params ['lastId'];
			$all = array ();
			foreach ( $query->each () as $hotel ) {
				$isLiked = 0;
				$rateRange = RateRange::find ()->where ( [ 
						'<=',
						'start',
						$hotel->reviewScore 
				] )->where ( [ 
						'>',
						'end',
						$hotel->reviewScore 
				] )->one ();
				
				$reviewScoreFinal = $rateRange->title . " (" . $hotel->reviewScore . ")";
				if ($hotel->reviewScore == 0 || $hotel->reviewScore == '') {
					$reviewScoreFinal = "";
				}
				if ($params ['userId'] != "") {
					$userLike = UserHotelLike::find ()->where ( [ 
							'user_id' => $params ['userId'] 
					] )->where ( [ 
							'hotel_id' => $hotel->id 
					] )->count ();
					if ($userLike > 0)
						$isLiked = 1;
				}
				$hotelImages = HotelsImg::find ()->where ( [ 
						'hotel_id' => $hotel->id 
				] )->all ();
				$img = array ();
				foreach ( $hotelImages as $hotelImage ) {
					$img [] = $hotelImage->img;
				}
				$hotelServices = Services::find ()->join ( 'JOIN', 'services_hotel', 'services_hotel.service_id = services.id' )->where ( [ 
						'services_hotel.hotel_id' => $hotel->id 
				] )->all ();
				$services = [ ];
				foreach ( $hotelServices as $hotelService ) {
					$services [] = [ 
							"id" => $hotelService->id,
							"title" => $hotelService->title,
							"imageURL" => $hotelService->img 
					];
				}
				$count ++;
				$response = [ 
						"recordId" => $count,
						"hotelId" => $hotel->id,
						"name" => $hotel->name,
						"location" => $hotel->location,
						"longitude" => $hotel->longitude,
						"latitude" => $hotel->latitude,
						"bookingLink" => $hotel->bookingLink,
						"reviewScore" => $reviewScoreFinal,
						"ratingStar" => $hotel->ratingStar,
						"offerExists" => $hotel->offerExists,
						"isLiked" => $isLiked,
						"gallery" => $img,
						"descrip" => $hotel->descrip,
						"offerTitle" => $hotel->offerTitle,
						"offerDescription" => $hotel->offerDescription,
						"services" => $services,
						"accomadtionType" => $hotel->accomadtionType,
						"elgounaVoice" => $hotel->elgounaVoice,
						"email" => $hotel->email,
						"phoneNumber" => $hotel->phoneNumber,
						"info" => $hotel->info,
						"facebookLink" => $hotel->facebookLink,
						"twitterLink" => $hotel->twitterLink,
						"instagramLink" => $hotel->instagramLink,
						"youtubeLink" => $hotel->youtubeLink 
				];
				$all ['hotels'] [] = $response;
			}
			$this->sendSuccessResponse2 ( 1, 200, $all );
		} else
			$this->sendFailedResponse ( 0, 400, 'Invalid_Parameters' );
	}
}
