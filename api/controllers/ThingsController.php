<?php

namespace api\controllers;


use backend\models\BeachCategory;
use backend\models\Beaches;
use backend\models\BeachesImg;
use backend\models\BeachReview;
use backend\models\Location;
use backend\models\RateRange;


use backend\models\UserBeachLike;
use backend\models\Users;
use Yii;
use yii\filters\VerbFilter;

/**
 * Class BeachesController
 * @package api\controllers
 */
class ThingsController extends ApiController
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'category' => ['get'],
                    'list-things' => ['post'],
                    'get-thing-reviews' => ['post'],
                    'like-thing' => ['post'],
                    'submit-thing-review' => ['post'],
                    'get-thing-details' => ['post'],
                ],

            ]
        ];
    }

    public function actionCategory()
    {
        $cats = array();
        $categories = BeachCategory::find()
            ->orderBy(['ordering'=>SORT_ASC])
            ->all();
        foreach ($categories as $cat) {
            $response = [
                'id' => intval($cat->id),
                'title' => $this->stringVal($cat->title),
                'description' => $this->stringVal($cat->description),
                'image' => $this->stringVal($cat->image)
            ];
            $cats[] = $response;
        }
        $this->sendSuccessResponse(1,200,$cats);
    }


    public function actionListThings()
    {
        $limit = "5";
        $start = "0";
        $count = 0;
        $params = $this->parseRequest();
        print_r($params);
        if(isset($params['lastId']) && $params['lastId']!='') {

            $count = $params['lastId'];
            $start = $count + 1;

            $query = Beaches::find();

            if (isset($params['keyword']) && ($params['keyword'] != '')) {
                $keyword = $params['keyword'];
                $query->andFilterWhere(['like', 'name', $keyword]);
            }

            if (isset($params['priceType']) && ($params['priceType'] != '')) {
                $priceType = $params['priceType'];
                $query->andWhere(['price_type' => $priceType]);
            }

            if (isset($params['visaCheck']) && ($params['visaCheck'] != '')) {
                $visaCheck = $params['visaCheck'];
                $query->andWhere(['isVisaPaymentAvailable' => $visaCheck]);
            }

            if (isset($params['popularity']) && ($params['popularity'] != '')) {
                $popularity = $params['popularity'];
                $query->andWhere(['popularity' => $popularity]);
            }

            if (isset($params['locationId']) && ($params['locationId'] != '')) {
                $locationId = $params['locationId'];
                $query->andWhere(['location_id' => $locationId]);
            }

            if (isset($params['categoryId']) && ($params['categoryId'] != '')) {
                $categoryId = $params['categoryId'];
                $query->andWhere(['category_id' => $categoryId]);
            }

            if (isset($params['placeType']) && ($params['placeType'] != '')) {
                $placeType = $params['placeType'];
                $query->andWhere(['place_type' => $placeType]);
            }

            if (isset($params['wifiCheck']) && ($params['wifiCheck'] != '')) {
                $wifiCheck = $params['wifiCheck'];
                $query->andWhere(['isWifiAvailable' => $wifiCheck]);
            }

            $all = array();
            $beaches = $query
                ->limit($limit)
                ->offset($start)
                ->orderBy(['ord' => SORT_ASC])->all();

            //print_r($query);die;
            foreach ($beaches as $row) {
                $count++;

                $row_r = RateRange::find()
                    ->where(['<=', 'start', $row['reviewScore']])
                    ->andWhere(['>', 'end', $row['reviewScore']])
                    ->one();

                $reviewScoreFinal = $row_r['title'] . " (" . $row['reviewScore'] . ")";
                if ($row['reviewScore'] == 0 || $row['reviewScore'] == '') {
                    $reviewScoreFinal = '';
                }

                $images = BeachesImg::getOneImg($row->id);
                $response = [
                    "recordId" => intval($count),
                    "thingId" => $row['id'],
                    "name" => $this->stringVal($row['name']),
                    "category" => $this->stringVal($row->category['title']),
                    "image" => $images,
                ];
                $all[] = $response;
            }

            $this->sendSuccessResponse(1, 200, $all);
        }
        else{
            $this->sendFailedResponse(0,402,'Invalid Parameters Missing lastId');
        }
    }


    public function actionGetThingReviews()
    {
        $limit = "20";
        $start = "0";
        $count = 0;
        $params = $this->parseRequest();

        if(isset($params['beachId']) && $params['beachId']!='') {
            $beach_id = $params['beachId'];

            if (isset($params['lastId']) && $params['lastId'] != '') {
                $count = $params['lastId'];
                $start = $count + 1;
            }
            $query = BeachReview::find()
                ->where(['approved'=>1])
                ->andWhere(['beach_id' => $beach_id])
                ->limit($limit)
                ->offset($start)
                ->orderBy(['date' => SORT_ASC]);

            $reviews = $query->all();

            $all = array();
            foreach ($reviews as $row) {
                $count++;

                $row_u = Users::find()->where(['id'=>$row['user_id']])->one();
                if ($row_u['imageURL'] != '') {

                    $imgURL = $row_u['imageURL'];
                } else {

                    $imgURL = '';
                }
                $user = array(
                    "username" => $this->stringVal($row_u['name']),
                    "imgURL" => $this->stringVal($imgURL)
                );

                $all['reviews'][] = array(
                    "recordId" => $count,
                    "id" => $row['id'],
                    "review" => $this->stringVal($row['review']),
                    "rating" =>$this->stringVal( $row['rating']),
                    "date" => $this->stringVal($row['date']),
                    "user" => $user,
                );
            }
            $this->sendSuccessResponse2(1, 200, $all);
        }
        else{
            $this->sendFailedResponse(0,400,'Invalid_Parameters');
        }
    }


    public function actionLikeThing()
    {
        $params = $this->parseRequest();
        if(isset($params['userId'])  &&  isset($params['beachId']) ) {
            $n_like = UserBeachLike::find()
                ->where(['user_id'=> $params['userId'] ])
                ->andWhere(['beach_id' => $params['beachId']])
                ->one();
            if($n_like['id']!='') {

            }else
            {
                $new = new UserBeachLike();
                $new->user_id = $params['userId'];
                $new->beach_id = $params['beachId'];
                $new->date = date('Y-m-d H:i:s');
                $new->save();
            }

            $this->sendSuccessResponse(1,200);
        }
        else{
            $this->sendFailedResponse(0,402,'Invalid_Parameters');
        }

    }


    public function actionSubmitThingReview()
    {
        $params = $this->parseRequest();
        if(isset($params['userId'])  &&  isset($params['beachId'])
            &&  isset($params['review']) &&  isset($params['rating'])
        )
        {
            $new = new BeachReview();
            $new->user_id = $params['userId'];
            $new->beach_id = $params['beachId'];
            $new->rating = $params['rating'];
            $new->review = $params['review'];
            $new->date = date('Y-m-d H:i:s');
            $new->approved = 0;
            $new->save();

            $Reviews = BeachReview::findAll(['beach_id'=>$params['beachId'] , 'approved'=>1 ]);
            $beach = Beaches::findOne(['id'=>$params['beachId'] ]);
            $sum = 0;
            $total=count($Reviews);
            foreach ($Reviews as $review){
                $sum += $review->rating;
            }
            $beach->reviewScore = ($sum/$total);
            $beach->save();

            $this->sendSuccessResponse(1,200);
        }
        else{
            $this->sendFailedResponse(0,402,'Invalid_Parameters');
        }

    }


    public function actionGetThingDetails()
    {
        $params = $this->parseRequest();

        if(isset($params['thingId']) && $params['thingId']!='') {
            $thing_id = $params['thingId'];

            $row = Beaches::findOne(['id' => $thing_id]);

            $row_r = RateRange::find()
                ->where(['<=', 'start', $row['reviewScore']])
                ->andWhere(['>', 'end', $row['reviewScore']])
                ->one();

            $reviewScoreFinal = $row_r['title'] . " (" . $row['reviewScore'] . ")";
            if ($row['reviewScore'] == 0 || $row['reviewScore'] == '') {
                $reviewScoreFinal = '';
            }


            $isLiked = 0;
            if (isset($params['userId']) && $params['userId'] != "") {
                $n_like = UserBeachLike::find()
                    ->where(['user_id' => $params['userId']])
                    ->andWhere(['beach_id' => $row['id']])
                    ->one();
                if ($n_like) {
                    $isLiked = 1;
                }
            }

            $images = BeachesImg::getImgs($row->id);
            $response = [
                "recordId" => 1,
                "thingId" => $row['id'],
                "name" => $this->stringVal($row['name']),
                "type" => $this->stringVal($row['type']),
                "location" => $this->stringVal($row['location']),
                "longitude" => $this->stringVal($row['longitude']),
                "latitude" => $this->stringVal($row['latitude']),
                "reviewScore" => $this->stringVal($reviewScoreFinal),
                "ratingStar" => $this->stringVal($row['ratingStar']),
                "offerExists" => $this->stringVal($row['offerExists']),
                "isLiked" => $this->stringVal($isLiked),
                "descrip" => $this->stringVal($row['descrip']),
                "offerTitle" => $this->stringVal($row['offerTitle']),
                "offerDescription" => $this->stringVal($row['offerDescription']),
                "isPoolAvailable" => $this->stringVal($row['isPoolAvailable']),
                "isGymAvailable" => $this->stringVal($row['isGymAvailable']),
                "isWifiAvailable" => $this->stringVal($row['isWifiAvailable']),
                "isVisaPaymentAvailable" => $this->stringVal($row['isVisaPaymentAvailable']),
                "isDiningInAvailable" => $this->stringVal($row['isDiningInAvailable']),
                "accomadtionType" => $this->stringVal($row['accomadtionType']),
                "elgounaVoice" => $this->stringVal($row['elgounaVoice']),
                "email" => $this->stringVal($row['email']),
                "phoneNumber" => $this->stringVal($row['phoneNumber']),
                "info" => $this->stringVal($row['info']),
                "facebookLink" => $this->stringVal($row['facebookLink']),
                "twitterLink" => $this->stringVal($row['twitterLink']),
                "instagramLink" => $this->stringVal($row['instagramLink']),
                "youtubeLink" => $this->stringVal($row['youtubeLink']),
                "category" => $this->stringVal($row->category['title']),
                "priceType" => $this->stringVal($row->getTypeList()[$row->price_type]),
                "popularity" => $this->stringVal($row->getTypeList()[$row->popularity]),
                "locationType" => $this->stringVal($row->locationType['title']),
                "placeType" => $this->stringVal($row->getPlaceType()[$row->place_type]),
                "gallery" => $images,
            ];
            $all = $response;

            $this->sendSuccessResponse(1, 200, $all);
        }
        else{
            $this->sendFailedResponse(0,402,'Invalid Parameters Missing ID');
        }
    }



}
