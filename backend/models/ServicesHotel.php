<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "services_hotel".
 *
 * @property integer $id
 * @property integer $service_id
 * @property integer $hotel_id
 */
class ServicesHotel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'services_hotel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['service_id', 'hotel_id'], 'required'],
            [['service_id', 'hotel_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'service_id' => Yii::t('app', 'Service ID'),
            'hotel_id' => Yii::t('app', 'Hotel ID'),
        ];
    }
}
