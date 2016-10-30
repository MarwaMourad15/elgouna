<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "beaches".
 *
 * @property integer $id
 * @property string $name
 * @property string $type
 * @property string $location
 * @property string $longitude
 * @property string $latitude
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
 * @property integer $ord
 * @property integer $hidden
 * @property integer $category_id
 * @property integer $price_type
 * @property integer $popularity
 * @property integer $location_id
 * @property integer $place_type
 */
class Beaches extends \yii\db\ActiveRecord
{

    /**
     * Const for price type  /  popularity
     */
    const LOW = 0;
    const MEDIUM = 1;
    const HIGH = 2;

    /**
     * Const for place type
     */
    const BEACHFRONT= 0;
    const MARINAFRONT= 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'beaches';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'type', 'location', 'longitude', 'latitude', 'reviewScore', 'ratingStar', 'offerExists', 'descrip', 'offerTitle', 'offerDescription', 'isPoolAvailable', 'isGymAvailable', 'isWifiAvailable', 'isVisaPaymentAvailable', 'isDiningInAvailable', 'accomadtionType', 'elgounaVoice', 'email', 'phoneNumber', 'info', 'facebookLink', 'twitterLink', 'instagramLink', 'youtubeLink', 'ord', 'hidden'], 'required'],
            [['name', 'location', 'longitude', 'latitude', 'descrip', 'offerTitle', 'offerDescription', 'accomadtionType', 'elgounaVoice', 'email', 'phoneNumber', 'info', 'facebookLink', 'twitterLink', 'instagramLink', 'youtubeLink'], 'string'],
            [['reviewScore'], 'number'],
            [['ratingStar', 'offerExists', 'isPoolAvailable', 'isGymAvailable', 'isWifiAvailable', 'isVisaPaymentAvailable', 'isDiningInAvailable', 'ord', 'hidden', 'category_id', 'price_type', 'popularity', 'location_id', 'place_type'], 'integer'],
            [['type'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'type' => Yii::t('app', 'Type'),
            'location' => Yii::t('app', 'Location'),
            'longitude' => Yii::t('app', 'Longitude'),
            'latitude' => Yii::t('app', 'Latitude'),
            'reviewScore' => Yii::t('app', 'Review Score'),
            'ratingStar' => Yii::t('app', 'Rating Star'),
            'offerExists' => Yii::t('app', 'Offer Exists'),
            'descrip' => Yii::t('app', 'Descrip'),
            'offerTitle' => Yii::t('app', 'Offer Title'),
            'offerDescription' => Yii::t('app', 'Offer Description'),
            'isPoolAvailable' => Yii::t('app', 'Is Pool Available'),
            'isGymAvailable' => Yii::t('app', 'Is Gym Available'),
            'isWifiAvailable' => Yii::t('app', 'Is Wifi Available'),
            'isVisaPaymentAvailable' => Yii::t('app', 'Is Visa Payment Available'),
            'isDiningInAvailable' => Yii::t('app', 'Is Dining In Available'),
            'accomadtionType' => Yii::t('app', 'Accomadtion Type'),
            'elgounaVoice' => Yii::t('app', 'Elgouna Voice'),
            'email' => Yii::t('app', 'Email'),
            'phoneNumber' => Yii::t('app', 'Phone Number'),
            'info' => Yii::t('app', 'Info'),
            'facebookLink' => Yii::t('app', 'Facebook Link'),
            'twitterLink' => Yii::t('app', 'Twitter Link'),
            'instagramLink' => Yii::t('app', 'Instagram Link'),
            'youtubeLink' => Yii::t('app', 'Youtube Link'),
            'ord' => Yii::t('app', 'Ord'),
            'hidden' => Yii::t('app', 'Hidden'),
            'category_id' => Yii::t('app', 'Category ID'),
            'price_type' => Yii::t('app', 'Price Type'),
            'popularity' => Yii::t('app', 'Popularity'),
            'location_id' => Yii::t('app', 'Location ID'),
            'place_type' => Yii::t('app', 'Place Type'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBeachesImgs()
    {
        return $this->hasMany(BeachesImg::className(), ['beach_id' => 'id']);
    }

    public function getCategory()
    {
        return $this->hasOne(BeachCategory::className(), ['id' => 'category_id']);
    }

    public function getLocationType()
    {
        return $this->hasOne(Location::className(), ['id' => 'location_id']);
    }

    public static function getTypeList()
    {
        return array(
            self::LOW => 'Low',
            self::MEDIUM=>'Medium',
            self::HIGH=>'High',
        );
    }

    public static function getPlaceType()
    {
        return array(
            self::BEACHFRONT => 'Beach Front',
            self::MARINAFRONT=>'Marina Front',
        );
    }
}
