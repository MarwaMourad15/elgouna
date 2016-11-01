<?php

namespace api\controllers;

use backend\models\Location;
use backend\models\VenueCategory;
use backend\models\Venues;
use backend\models\VenuesImg;
use Yii;
use yii\filters\VerbFilter;

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
								'category' => [ 
										'get'
								],
								'list-dinings' => [ 
										'post' 
								],
                            'get-dining-details' => [
                                        'post'
                                    ]
						] 
				]
				 
		];
	}
	public function actionCategory() {
		$type = 0; // 0 dining 1 night life
		$cats = array ();
		$categories = VenueCategory::find ()->where ( [ 
				'type' => $type 
		] )->orderBy ( [ 
				'ordering' => SORT_ASC 
		] )->all ();
		foreach ( $categories as $cat ) {
			$response = [ 
					'id' => intval ( $cat->id ),
					'title' => $this->stringVal ( $cat->title ),
					'description' => $this->stringVal ( $cat->description ),
					'image' => $this->stringVal ( $cat->image ) 
			];
			$cats [] = $response;
		}
		$this->sendSuccessResponse ( 1, 200, $cats );
	}

	public function actionListDinings() {
        $limit = 10;
        $start = 0;
        $count = 0;

		$params = $this->parseRequest ();
        if(isset($params['lastId'])) {
            $count = $params['lastId'];
            $start = $count + 1;

            $categoryType = 0; // 0 dining 1 night life

            $query = Venues::find()->where([
                'category_type' => $categoryType
            ]);

            if (isset ($params ['keyword']) && ($params ['keyword'] != '')) {
                $keyword = $params ['keyword'];
                $query->andFilterWhere([
                    'like',
                    'name',
                    $keyword
                ]);
            }

            if (isset ($params ['priceType']) && ($params ['priceType'] != '')) {
                $priceType = $params ['priceType'];
                $query->andWhere([
                    'price_type' => $priceType
                ]);
            }

            if (isset ($params ['visaCheck']) && ($params ['visaCheck'] != '')) {
                $visaCheck = $params ['visaCheck'];
                $query->andWhere([
                    'visaCheck' => $visaCheck
                ]);
            }

            if (isset ($params ['popularity']) && ($params ['popularity'] != '')) {
                $popularity = $params ['popularity'];
                $query->andWhere([
                    'popularity' => $popularity
                ]);
            }

            if (isset ($params ['locationId']) && ($params ['locationId'] != '')) {
                $locationId = $params ['locationId'];
                $query->andWhere([
                    'location_id' => $locationId
                ]);
            }

            if (isset ($params ['categoryId']) && ($params ['categoryId'] != '')) {
                $categoryId = $params ['categoryId'];
                $query->andWhere([
                    'category_id' => $categoryId
                ]);
            }

            if (isset ($params ['placeType']) && ($params ['placeType'] != '')) {
                $placeType = $params ['placeType'];
                $query->andWhere([
                    'place_type' => $placeType
                ]);
            }

            if (isset ($params ['wifiCheck']) && ($params ['wifiCheck'] != '')) {
                $wifiCheck = $params ['wifiCheck'];
                $query->andWhere([
                    'wifiCheck' => $wifiCheck
                ]);
            }

            $all = array();
            $venues = $query
                ->limit($limit)
                ->offset($start)
                ->orderBy([
                'ord' => SORT_ASC
            ])->all();
            // print_r($venues);die;
            foreach ($venues as $venue) {
                $count++;
                $images = VenuesImg::getVenueOneImg($venue->id);
                $response = [
                    "recordId" => intval($count),
                    "id" => intval($venue->id),
                    "name" => $this->stringVal($venue->name),
                    "category" => $this->stringVal($venue->category ['title']),
                    "image" => $images
                ];
                $all[] = $response;
            }
            $this->sendSuccessResponse(1, 200, $all);
        }
        else{
            $this->sendFailedResponse(0,402,'Invalid Parameters Missing lastId');
        }
	}

    public function actionGetDiningDetails() {
        $params = $this->parseRequest ();

        if(isset($params['diningId'])) {
            $diningId = $params['diningId'];
            $venue = Venues::findOne(['id' => $diningId]);
                $images = VenuesImg::getVenueImg($venue->id);
                $response = [
                    "id" => intval($venue->id),
                    "name" => $this->stringVal($venue->name),
                    "type" => $this->stringVal($venue->type),
                    "location" => $this->stringVal($venue->location),
                    "longitude" => $this->stringVal($venue->longitude),
                    "latitude" => $this->stringVal($venue->latitude),
                    "review" => $this->stringVal($venue->reviewScore),
                    "rating" => $this->stringVal($venue->ratingStar),
                    "description" => $this->stringVal($venue->description),
                    "offerCheck" => $this->stringVal($venue->offerCheck),
                    "offerTitle" => $this->stringVal($venue->offerTitle),
                    "offerDescription" => $this->stringVal($venue->offerDescription),
                    "wifiCheck" => $this->stringVal($venue->wifiCheck),
                    "visaCheck" => $this->stringVal($venue->visaCheck),
                    "diningCheck" => $this->stringVal($venue->diningCheck),
                    "elgounaVoice" => $this->stringVal($venue->elgounaVoice),
                    "email" => $this->stringVal($venue->email),
                    "phoneNumber" => $this->stringVal($venue->phoneNumber),
                    "info" => $this->stringVal($venue->info),
                    "facebookLink" => $this->stringVal($venue->facebookLink),
                    "twitterLink" => $this->stringVal($venue->twitterLink),
                    "instagramLink" => $this->stringVal($venue->instagramLink),
                    "youtubeLink" => $this->stringVal($venue->youtubeLink),
                    "order" => $this->stringVal($venue->ord),
                    "merchantId" => $this->stringVal($venue->merchant_id),
                    "secureHash" => $this->stringVal($venue->secure_hash),
                    "category" => $this->stringVal($venue->category ['title']),
                    "priceType" => $this->stringVal($venue->getTypeList() [$venue->price_type]),
                    "popularity" => $this->stringVal($venue->getTypeList() [$venue->popularity]),
                    "locationType" => $this->stringVal($venue->locationType ['title']),
                    "placeType" => $this->stringVal($venue->getPlaceType() [$venue->place_type]),
                    "images" => $images
                ];
                $all[] = $response;

            $this->sendSuccessResponse(1, 200, $all);
        }
        else{
            $this->sendFailedResponse(0,402,'Invalid Parameters Missing ID');
        }
    }
}
