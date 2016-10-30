<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "hotels_img".
 *
 * @property integer $id
 * @property integer $hotel_id
 * @property string $img
 */
class HotelsImg extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hotels_img';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hotel_id', 'img'], 'required'],
            [['hotel_id'], 'integer'],
            [['img'], 'string'],
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
            'img' => Yii::t('app', 'Img'),
        ];
    }
}
