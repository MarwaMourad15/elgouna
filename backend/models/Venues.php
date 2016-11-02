<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "venues".
 *
 * @property integer $id
 * @property string $venueUsername
 * @property string $venuePass
 * @property string $name
 * @property string $type
 * @property string $location
 * @property string $longitude
 * @property string $latitude
 * @property double $reviewScore
 * @property integer $ratingStar
 * @property string $description
 * @property integer $offerCheck
 * @property string $offerTitle
 * @property string $offerDescription
 * @property integer $wifiCheck
 * @property integer $visaCheck
 * @property integer $diningCheck
 * @property string $elgounaVoice
 * @property string $email
 * @property string $phoneNumber
 * @property string $info
 * @property string $facebookLink
 * @property string $twitterLink
 * @property string $instagramLink
 * @property string $youtubeLink
 * @property integer $ord
 * @property string $merchant_id
 * @property string $secure_hash
 * @property integer $category_id
 * @property integer $price_type
 * @property integer $popularity
 * @property integer $location_id
 * @property integer $place_type
 * @property integer $category_type
 * @property integer $taste
 * @property integer $cleanliness
 * @property integer $rating
 *
 * @property Orders[] $orders
 * @property VenuesImg[] $venuesImgs
 */
class Venues extends \yii\db\ActiveRecord
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
        return 'venues';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['venueUsername', 'venuePass', 'name', 'type', 'location', 'reviewScore', 'ratingStar', 'offerCheck', 'wifiCheck', 'visaCheck', 'diningCheck', 'elgounaVoice', 'email', 'phoneNumber', 'info', 'facebookLink', 'twitterLink', 'instagramLink', 'youtubeLink', 'ord', 'secure_hash'], 'required'],
            [['reviewScore'], 'number'],
            [['ratingStar', 'offerCheck', 'wifiCheck', 'visaCheck', 'diningCheck', 'ord', 'category_id', 'price_type', 'popularity', 'location_id', 'place_type', 'category_type', 'taste', 'cleanliness', 'rating'], 'integer'],
            [['description'], 'string'],
            [['venueUsername', 'elgounaVoice', 'phoneNumber'], 'string', 'max' => 50],
            [['venuePass', 'name', 'email', 'info', 'secure_hash'], 'string', 'max' => 100],
            [['type', 'longitude', 'latitude', 'offerDescription', 'merchant_id'], 'string', 'max' => 1000],
            [['location', 'offerTitle', 'facebookLink', 'twitterLink', 'instagramLink', 'youtubeLink'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'venueUsername' => Yii::t('app', 'Venue Username'),
            'venuePass' => Yii::t('app', 'Venue Pass'),
            'name' => Yii::t('app', 'Name'),
            'type' => Yii::t('app', 'Type'),
            'location' => Yii::t('app', 'Location'),
            'longitude' => Yii::t('app', 'Longitude'),
            'latitude' => Yii::t('app', 'Latitude'),
            'reviewScore' => Yii::t('app', 'Review Score'),
            'ratingStar' => Yii::t('app', 'Rating Star'),
            'description' => Yii::t('app', 'Description'),
            'offerCheck' => Yii::t('app', 'Offer Check'),
            'offerTitle' => Yii::t('app', 'Offer Title'),
            'offerDescription' => Yii::t('app', 'Offer Description'),
            'wifiCheck' => Yii::t('app', 'Wifi Check'),
            'visaCheck' => Yii::t('app', 'Visa Check'),
            'diningCheck' => Yii::t('app', 'Dining Check'),
            'elgounaVoice' => Yii::t('app', 'Elgouna Voice'),
            'email' => Yii::t('app', 'Email'),
            'phoneNumber' => Yii::t('app', 'Phone Number'),
            'info' => Yii::t('app', 'Info'),
            'facebookLink' => Yii::t('app', 'Facebook Link'),
            'twitterLink' => Yii::t('app', 'Twitter Link'),
            'instagramLink' => Yii::t('app', 'Instagram Link'),
            'youtubeLink' => Yii::t('app', 'Youtube Link'),
            'ord' => Yii::t('app', 'Ord'),
            'merchant_id' => Yii::t('app', 'Merchant ID'),
            'secure_hash' => Yii::t('app', 'Secure Hash'),
            'category_id' => Yii::t('app', 'Category ID'),
            'price_type' => Yii::t('app', 'Price Type'),
            'popularity' => Yii::t('app', 'Popularity'),
            'location_id' => Yii::t('app', 'Location ID'),
            'place_type' => Yii::t('app', 'Place Type'),
            'category_type' => Yii::t('app', 'Category Type'),
            'taste' => Yii::t('app', 'Taste'),
            'cleanliness' => Yii::t('app', 'Cleanliness'),
            'rating' => Yii::t('app', 'Rating'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVenuesImgs()
    {
        return $this->hasMany(VenuesImg::className(), ['venue_id' => 'id']);
    }

    public function getCategory()
    {
        return $this->hasOne(VenueCategory::className(), ['id' => 'category_id']);
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


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['venue_id' => 'id']);
    }

}
