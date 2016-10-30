<?php

namespace backend\models;

use Yii;
/**
 * This is the model class for table "user_beach_like".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $beach_id
 * @property string $date
 */
class UserBeachLike extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_beach_like';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'beach_id', 'date'], 'required'],
            [['user_id', 'beach_id'], 'integer'],
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
            'beach_id' => Yii::t('app', 'Beach ID'),
            'date' => Yii::t('app', 'Date'),
        ];
    }
}
