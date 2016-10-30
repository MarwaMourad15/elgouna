<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $userAuth
 * @property string $name
 * @property string $imageURL
 * @property string $phoneNumber
 * @property integer $gender
 * @property string $birthDate
 * @property string $address
 * @property string $email
 * @property string $zipCode
 * @property integer $notificationsEnabled
 * @property integer $mapsEnabled
 * @property string $elgounaPhone
 * @property string $elgounaSMS
 * @property string $elgounaemail
 * @property string $fbId
 * @property string $ehgzly_user_token
 * @property string $ehgzly_user_id
 * @property string $auth_reset_token
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userAuth', 'name', 'imageURL', 'phoneNumber', 'gender', 'birthDate', 'address', 'email', 'zipCode', 'notificationsEnabled', 'mapsEnabled', 'elgounaPhone', 'elgounaSMS', 'elgounaemail', 'fbId'], 'required'],
            [['userAuth', 'name', 'imageURL', 'phoneNumber', 'birthDate', 'address', 'email', 'zipCode', 'elgounaPhone', 'elgounaSMS', 'elgounaemail', 'fbId'], 'string'],
            [['gender', 'notificationsEnabled', 'mapsEnabled'], 'integer'],
            [['ehgzly_user_token', 'ehgzly_user_id'], 'string', 'max' => 1000],
            [['auth_reset_token'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'userAuth' => Yii::t('app', 'User Auth'),
            'name' => Yii::t('app', 'Name'),
            'imageURL' => Yii::t('app', 'Image Url'),
            'phoneNumber' => Yii::t('app', 'Phone Number'),
            'gender' => Yii::t('app', 'Gender'),
            'birthDate' => Yii::t('app', 'Birth Date'),
            'address' => Yii::t('app', 'Address'),
            'email' => Yii::t('app', 'Email'),
            'zipCode' => Yii::t('app', 'Zip Code'),
            'notificationsEnabled' => Yii::t('app', 'Notifications Enabled'),
            'mapsEnabled' => Yii::t('app', 'Maps Enabled'),
            'elgounaPhone' => Yii::t('app', 'Elgouna Phone'),
            'elgounaSMS' => Yii::t('app', 'Elgouna Sms'),
            'elgounaemail' => Yii::t('app', 'Elgounaemail'),
            'fbId' => Yii::t('app', 'Fb ID'),
            'ehgzly_user_token' => Yii::t('app', 'Ehgzly User Token'),
            'ehgzly_user_id' => Yii::t('app', 'Ehgzly User ID'),
            'auth_reset_token' => Yii::t('app', 'Auth Reset Token'),
        ];
    }
}
