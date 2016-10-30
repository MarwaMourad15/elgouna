<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "settings".
 *
 * @property integer $id
 * @property string $bookingURL
 * @property string $facebookURL
 * @property string $elgounaURL
 * @property string $twitterURL
 * @property string $youtubeURL
 * @property string $instagramURL
 * @property string $snapchatURL
 * @property string $elgounaPhone
 * @property string $elgounaSMS
 * @property string $elgounaemail
 * @property string $about
 * @property string $paymobAPIKey
 * @property string $paymobSecretKey
 * @property string $paymobMerchantId
 * @property string $paymobSecureHash
 */
class Settings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'settings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bookingURL', 'facebookURL', 'elgounaURL', 'twitterURL', 'youtubeURL', 'instagramURL', 'elgounaPhone', 'elgounaSMS', 'elgounaemail'], 'required'],
            [['bookingURL', 'facebookURL', 'elgounaURL', 'twitterURL', 'youtubeURL', 'instagramURL', 'elgounaPhone', 'elgounaSMS', 'elgounaemail'], 'string'],
            [['snapchatURL'], 'string', 'max' => 500],
            [['about'], 'string', 'max' => 50000],
            [['paymobAPIKey', 'paymobSecretKey', 'paymobMerchantId', 'paymobSecureHash'], 'string', 'max' => 800],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'bookingURL' => Yii::t('app', 'Booking Url'),
            'facebookURL' => Yii::t('app', 'Facebook Url'),
            'elgounaURL' => Yii::t('app', 'Elgouna Url'),
            'twitterURL' => Yii::t('app', 'Twitter Url'),
            'youtubeURL' => Yii::t('app', 'Youtube Url'),
            'instagramURL' => Yii::t('app', 'Instagram Url'),
            'snapchatURL' => Yii::t('app', 'Snapchat Url'),
            'elgounaPhone' => Yii::t('app', 'Elgouna Phone'),
            'elgounaSMS' => Yii::t('app', 'Elgouna Sms'),
            'elgounaemail' => Yii::t('app', 'Elgounaemail'),
            'about' => Yii::t('app', 'About'),
            'paymobAPIKey' => Yii::t('app', 'Paymob Apikey'),
            'paymobSecretKey' => Yii::t('app', 'Paymob Secret Key'),
            'paymobMerchantId' => Yii::t('app', 'Paymob Merchant ID'),
            'paymobSecureHash' => Yii::t('app', 'Paymob Secure Hash'),
        ];
    }
}
