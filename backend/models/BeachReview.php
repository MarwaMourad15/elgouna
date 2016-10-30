<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "beach_review".
 *
 * @property integer $id
 * @property integer $beach_id
 * @property integer $user_id
 * @property string $review
 * @property integer $rating
 * @property string $date
 * @property integer $approved
 */
class BeachReview extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'beach_review';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['beach_id', 'user_id', 'review', 'rating', 'date', 'approved'], 'required'],
            [['beach_id', 'user_id', 'rating', 'approved'], 'integer'],
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
            'beach_id' => Yii::t('app', 'Beach ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'review' => Yii::t('app', 'Review'),
            'rating' => Yii::t('app', 'Rating'),
            'date' => Yii::t('app', 'Date'),
            'approved' => Yii::t('app', 'Approved'),
        ];
    }
}
