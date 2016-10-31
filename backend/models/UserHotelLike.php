<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user_hotel_like".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $hotel_id
 * @property string $date
 */
class UserHotelLike extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_hotel_like';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'hotel_id', 'date'], 'required'],
            [['user_id', 'hotel_id'], 'integer'],
            [['date'], 'safe'],
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
            'hotel_id' => Yii::t('app', 'Hotel ID'),
            'date' => Yii::t('app', 'Date'),
        ];
    }
}
