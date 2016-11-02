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

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord || (!$this->isNewRecord && $this->password)) {
                $this->setPassword($this->password);
            }
            return true;
        }
        return false;
    }

    protected function setPassword($password){

        $this->userAuth = Yii::$app->security->generatePasswordHash($password);
    }

    protected function validatePassword ($password){
        return Yii::$app->security->validatePassword($password, $this->userAuth);
    }

    public function sendResetPassowrd(){
        $resetLink = $resetLink = 'http://elgounaapp.com/elgouna/frontend/web/site/reset-password?token=' . $this->auth_reset_token;
        $message= '
            <div class="container" style="width: 90%; background-color: #f2f2f2; margin: 0 auto;">
            <div class="content" style="padding-bottom: 30px;padding-top: 30px;padding-left: 2%">
                <h2 style="color: #2d2d2d; font-weight: 600;">Hi <span>Member</span>!</h2>
                <p style="color: #545151;">
                    Hello <span>'.$this->fullName.'</span>, You Recently Requested To Reset Your Password For Your EL Gouna Account.
                    <br>
                        Click The Button Below To Reset It
                    <br>
                    <a href= '.$resetLink.' target="_blank" style="text-decoration: none">
                    <button style=" background-color: #1b6997; border: 1px solid #1b6997;height: 30px; color: white;
                                        font-weight: bolder; cursor: pointer; display:block; margin: auto ">
                        Reset Your Password
                    </button>
                    </a>
                    <br>
                        If You Did not Request A Password Reset, Please Ignore This Email Or Reply To Let Us Know.
                        This Password Reset Is Only Valid For The Next 30 Minutes.
                    <br>
                    <h4>
                        With All Regards,
                        <br>
                        El Gouna Team
                    </h4>
                </p>
            </div>
        </div>';
        //$fromMail = 'marwa@fumestudio.com';
        $tomail = $this->email;

        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        //$headers .= 'To: <' .$tomail .'>' . "\r\n";
        $headers .= 'From:'. 'info@elgouna.com'  . "\r\n";

        if (mail($tomail,'Elgouna App - Password Reset Verification' ,$message,$headers)){
            return 1;
        }
        else{
            return 0;
        }
    }

    public function removeAuthResetToken(){
        $this->auth_reset_token = '';
        return;
    }
}
