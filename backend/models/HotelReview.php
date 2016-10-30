<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "hotel_review".
 *
 * @property integer $id
 * @property integer $hotel_id
 * @property integer $user_id
 * @property string $review
 * @property integer $rating
 * @property string $date
 * @property integer $approved
 */
class HotelReview extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hotel_review';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hotel_id', 'user_id', 'review', 'rating', 'date', 'approved'], 'required'],
            [['hotel_id', 'user_id', 'rating', 'approved'], 'integer'],
            [['review'], 'string'],
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
            'hotel_id' => Yii::t('app', 'Hotel ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'review' => Yii::t('app', 'Review'),
            'rating' => Yii::t('app', 'Rating'),
            'date' => Yii::t('app', 'Date'),
            'approved' => Yii::t('app', 'Approved'),
        ];
    }
}
