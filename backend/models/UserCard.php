<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user_card".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $card_ending_with
 * @property string $adding_date
 * @property string $paymob_token
 */
class UserCard extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_card';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'card_ending_with', 'adding_date', 'paymob_token'], 'required'],
            [['user_id'], 'integer'],
            [['adding_date'], 'safe'],
            [['card_ending_with'], 'string', 'max' => 4],
            [['paymob_token'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'card_ending_with' => Yii::t('app', 'Card Ending With'),
            'adding_date' => Yii::t('app', 'Adding Date'),
            'paymob_token' => Yii::t('app', 'Paymob Token'),
        ];
    }
}
