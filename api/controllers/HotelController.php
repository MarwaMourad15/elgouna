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
use Yii;
use yii\filters\VerbFilter;
use backend\models\HotelReview;

/**
 * Class VenueController
 *
 * @package api\controllers
 */
class HotelController extends ApiController {
	public function behaviors() {
		return [ 
				'verbs' => [ 
						'class' => VerbFilter::className (),
						'actions' => [ 
								'category' => [ 
										'get' 
								],
								'list-hotels' => [ 
										'post' 
								] 
						] 
				] 
		];
	}
	public function actionHotelReviews() {
		$params = $this->parseRequest ();
		$limit = "20";
		$start = $params ['lastId'];
		$reviewPro = 0;
		$all = [ ];
		if ($params ['lastId'] == 0) {
			$hotel = Hotels::find ()->where ( [ 
					'id' => $params ['hotelId'] 
			] )->one ();
			if ($hotel->pid != 0) {
				$reviewsData = file_get_contents ( 'http://connect.reviewpro.com/v1/lodging/review/published?pid=' . $row ['pid'] . '&api_key=3xr4g6us6xmf5xq6abz84kbh5u3b9vght2xa29pd&sig=b396f6a3bb4e98c9ebe1e56e6518afa40700344456937ea1d21d6c142507ec3e' );
				$reviewsData = json_decode ( $reviewsData );
				// print_r($reviewsData);
				$rr = 0;
				foreach ( $reviewsData->productReviews as $s => $x ) {
					foreach ( $x->reviews as $n => $m ) {
						$reviewPro ++;
						$userData = new stdClass ();
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
		$count = $params ['lastId'];
		foreach ( $hotelReviews as $hotelReview ) {
			$count ++;
			$user = Users::find ()->where ( [ 
					'id' => $hotelReview->user_id 
			] )->one ();
			if ($user->imgURL != '') {
				$imgURL = $user->imgURL;
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
		
		if ($reviewPro == 0 && $hotelReviews->count == 0) {
			$all ['reviews'] = array ();
		}
		$this->sendSuccessResponse ( 1, 200, $all );
	}
	public function actionHotelFilter() {
		$params = $this->parseRequest ();
		$hotels = Hotels::find ();
		if ($params ['keyword'] != "") {
			$hotels->andWhere ( [ 
					'like',
					'name',
					$params ['keyword'] 
			] );
		}
		if (! empty ( $params ['ratingStar'] ) || $params ['ratingStar'] == '0') {
			$hotels->andWhere ( [ 
					'ratingStar' => $params ['ratingStar'] 
			] );
		}
		if ($params ['servicesIds'] != "") {
			$hotelServices = ServicesHotel::find ()->Where ( 'in', 'service_id', $params ['servicesIds'] )->groupBy ( 'hotel_id' )->all ();
			$ids = [ ];
			foreach ( $hotelServices as $hotelService ) {
				$ids [] = $hotelService->hotel_id;
			}
			if (count ( $ids ) > 0) {
				$hotels->andWhere( [ 
						'in',
						'id',
						$ids 
				] );
			}
		}
		$hotels->orderBy ( 'ord asc' );
		
		$count = $params ['lastId'];
		foreach ( $hotels as $hotel ) {
			$rateRange=RateRange::find()->where(['<=','start',$hotel->reviewScore])->andWhere(['>','end',$hotel->reviewScore])->one();
			if($rateRange->title == 'Poor'){
				$reviewScoreFinal="--";
			}else{
				$reviewScoreFinal=$rateRange->title." (".$hotel->reviewScore.")";
			}
				
		}
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
		$this->sendSuccessResponse ( 1, 200, $all );
	}
	public function actionServices() {
		$servs = [ ];
		$services = ServicesHotel::find ()->orderBy ( [ 
				'ordering' => SORT_ASC 
		] )->all ();
		foreach ( $services as $serv ) {
			$response = [ 
					'id' => intval ( $serv->id ),
					'title' => $this->stringVal ( $serv->title ),
					'description' => $this->stringVal ( $serv->description ),
					'image' => $this->stringVal ( $serv->image ) 
			];
			$servs [] = $response;
		}
		$this->sendSuccessResponse ( 1, 200, $servs );
	}
	public function actionListHotels() {
		$params = $this->parseRequest ();
		$hotelFilter = null;
		if ($params ['filterId'] != "") {
			$hotelFilter = HotelFilter::find ()->where ( [ 
					'id' => $params ['filterId'] 
			] )->one ();
		}
		$start = 0;
		$query = Hotels::find ()->limit ( 20 );
		if (isset ( $params ['query'] ) && $params ['query'] != "") {
			$query->andFilterCompare ( [ 
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
		if (isset ( $params ['lastId'] ) && ! empty ( $params ['lastId'] )) {
			$query->offset ( $params ['lastId'] );
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
	}
}
