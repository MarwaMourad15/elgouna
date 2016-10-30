<?php

namespace api\controllers;

use backend\models\Location;

use backend\models\Settings;
use Yii;
use yii\filters\VerbFilter;

/**
 * Class SettingController
 * @package frontend\controllers
 */
class SettingController extends ApiController
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'settings' => ['get'],
                    'locations' => ['get'],
                    'upload-photo' => ['post'],
                ],

            ]
        ];
    }

    public function actionSettings()
    {
        $setting = Settings::find()->where('id=:id',[':id' => 1])->one();
        if($setting){
            $this->sendSuccessResponse2(1,200,[
                'bookingURL'=>$this->stringVal($setting['bookingURL']),
                'facebookURL'=>$this->stringVal($setting['facebookURL']),
                'elgounaURL' =>$this->stringVal($setting['elgounaURL']),
                'twitterURL' =>$this->stringVal($setting['twitterURL']),
                'youtubeURL' =>$this->stringVal($setting['youtubeURL']),
                'instagramURL'=>$this->stringVal($setting['instagramURL']),
                'snapchatURL' =>$this->stringVal($setting['snapchatURL']),
                'elgounaPhone' =>$this->stringVal($setting['elgounaPhone']),
                'elgounaSMS'=>$this->stringVal($setting['elgounaSMS']),
                'elgounaemail'=>$this->stringVal($setting['elgounaemail']),
                'paymobAPIKey'=>$this->stringVal($setting['paymobAPIKey']),
                'paymobSecretKey'=>$this->stringVal($setting['paymobSecretKey']),
                'paymobMerchantId'=>$this->stringVal($setting['paymobMerchantId']),
                'paymobSecureHash'=>$this->stringVal($setting['paymobSecureHash']),
                'about'=>$this->stringVal($setting['about']),
                ]);
        }
        else{
            $this->sendFailedResponse(0,400,'Something_Went_Wrong_Please_Try_Again_Later');
        }
    }

    public function actionLocations()
    {
        $all = array();
        $Locations = Location::find()
            ->orderBy(['ordering'=>SORT_ASC])
            ->all();
        foreach ($Locations as $loc) {
            $response = [
                'id' => intval($loc->id),
                'title' => $this->stringVal($loc->title)
            ];
            $all[] = $response;
        }
        $this->sendSuccessResponse(1,200,$all);
    }




    public function actionUploadPhoto(){
        $params = $this->parseRequest();
        if (isset($params['id']) && isset($params['token'])&& isset($params['image'])&& isset($params['extension'])){
            if ($this->checkPatientToken($params['id'], $params['token'])) {
                $ext = $params['extension'];
                $img = $params['image'];
                if(!$this->checkImageExtension($ext))
                {
                    $this->sendFailedResponse(0, 704, 'Invalid_Image_Extension');
                }else {
                    $response = $this->uploadPhoto($ext, $img, '/uploads');
                    if($response['code']==200){
                        $this->sendSuccessResponse(1,200,['url'=>$response['message']]);
                    }
                    else if ($response['code']==400){
                        $this->sendFailedResponse(0,400,$response['message']);
                    }
                }
            }
            else{
            $this->sendFailedResponse(0,400,'Invalid_Token');
            }
        }
        else{
            $this->sendFailedResponse(0,400,'Invalid_Parameters');
        }
        /*define('UPLOAD_DIR', '../../uploads/');
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $file = UPLOAD_DIR . uniqid() . '.png';
        $success = file_put_contents($file, $data);
        $file = str_replace("../..",Yii::$app->homeUrl,$file);
        if($success)
            $this->sendSuccessResponse(1,200,['url'=>$file]);
        else
            $this->sendFailedResponse(0,400,'Error_Uploading_Image');*/
    }
}
