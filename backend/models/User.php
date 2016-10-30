<?php
namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $role
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 * @property string $first_name
 * @property string $last_name
 * @property string $mobile
 * @property string $office_phone
 * @property string $fax
 * @property integer $account_id
 * @property string $other_account_name
 * @property string $account_website
 * @property string $title
 * @property integer $mailing_country_id
 * @property string $mailing_city
 * @property string $mailing_address
 * @property integer $interest_id
 */
class User extends \common\models\User
{
    public $password;
    public $repassword;
    private $_statusLabel;
    private $_roleLabel;

    /**
     * @inheritdoc
     */
    public function getStatusLabel()
    {
        if ($this->_statusLabel === null) {
            $statuses = self::getArrayStatus();
            $this->_statusLabel = $statuses[$this->status];
        }
        return $this->_statusLabel;
    }

    /**
     * @inheritdoc
     */
    public static function getArrayStatus()
    {
        return [
            self::STATUS_ACTIVE => Yii::t('app', 'STATUS_ACTIVE'),
            self::STATUS_INACTIVE => Yii::t('app', 'STATUS_INACTIVE'),
            self::STATUS_DELETED => Yii::t('app', 'STATUS_DELETED'),
        ];
    }

    public static function getArrayRole()
    {
        return ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'description');
    }

    public function getRoleLabel()
    {

        if ($this->_roleLabel === null) {
            $roles = self::getArrayRole();
            $this->_roleLabel = $roles[$this->role];
        }
        return $this->_roleLabel;
    }

    /**
      * @inheritdoc
      */
    public function rules()
    {
        return [
            [['username', 'email'], 'required', 'on' => ['admin-create']],
            [['password', 'repassword'], 'required', 'on' => ['admin-create']],
            [['username', 'email', 'password', 'repassword'], 'trim'],
            [['password', 'repassword'], 'string', 'min' => 6, 'max' => 30],
            // Unique
            [['username', 'email'], 'unique'],
            // Username
            ['username', 'match', 'pattern' => '/^[a-zA-Z0-9_-]+$/'],
            ['username', 'string', 'min' => 3, 'max' => 30],
            // E-mail
            ['email', 'string', 'max' => 100],
            ['email', 'email'],
            // Repassword
            ['repassword', 'compare', 'compareAttribute' => 'password'],
            //['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_DELETED]],

            // Status
            ['role', 'in', 'range' => array_keys(self::getArrayRole())],

            [['first_name','last_name', 'email', 'password', 'repassword'], 'required', 'on' => ['sign-up']],
            [['account_id', 'mailing_country_id', 'interest_id'], 'integer'],
            [['first_name', 'last_name'], 'string', 'max' => 80],
            [['mobile', 'office_phone', 'fax', 'title'], 'string', 'max' => 50],
            [['other_account_name'], 'string', 'max' => 150],
            [['account_website'], 'string', 'max' => 100],
            [['mailing_city'], 'string', 'max' => 40],
            [['mailing_address'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return [
            'admin-create' => ['username', 'email', 'password', 'repassword', 'status', 'role'],
            'admin-update' => ['username', 'email', 'password', 'repassword', 'status', 'role'],
            'sign-up' => ['first_name','last_name', 'email', 'password', 'repassword'
                , 'account_id', 'mailing_country_id', 'interest_id', 'mobile', 'office_phone', 'fax', 'title'
                , 'other_account_name', 'account_website', 'mailing_city', 'mailing_address', 'status', 'role'
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        $labels = parent::attributeLabels();

        return array_merge(
            $labels,
            [
                'password' => Yii::t('app', 'Password'),
                'repassword' => Yii::t('app', 'Repassword'),
                'first_name' => Yii::t('app', 'First Name'),
                'last_name' => Yii::t('app', 'Last Name'),
                'mobile' => Yii::t('app', 'Mobile'),
                'office_phone' => Yii::t('app', 'Office Phone'),
                'fax' => Yii::t('app', 'Fax'),
                'account_id' => Yii::t('app', 'Account'),
                'other_account_name' => Yii::t('app', 'Other Account Name'),
                'account_website' => Yii::t('app', 'Account Website'),
                'title' => Yii::t('app', 'Title'),
                'mailing_country_id' => Yii::t('app', 'Mailing Country'),
                'mailing_city' => Yii::t('app', 'Mailing City'),
                'mailing_address' => Yii::t('app', 'Mailing Address'),
                'interest_id' => Yii::t('app', 'Interest')
            ]
        );
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord || (!$this->isNewRecord && $this->password)) {
                $this->setPassword($this->password);
                $this->generateAuthKey();
                $this->generatePasswordResetToken();
            }
            return true;
        }
        return false;
    }
}
