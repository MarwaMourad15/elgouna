<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "weather_days".
 *
 * @property integer $id
 * @property integer $w_id
 * @property string $dayName
 * @property string $w_temp
 * @property string $w_descr
 */
class WeatherDays extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'weather_days';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['w_id', 'dayName', 'w_temp', 'w_descr'], 'required'],
            [['w_id'], 'integer'],
            [['dayName', 'w_temp', 'w_descr'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'w_id' => Yii::t('app', 'W ID'),
            'dayName' => Yii::t('app', 'Day Name'),
            'w_temp' => Yii::t('app', 'W Temp'),
            'w_descr' => Yii::t('app', 'W Descr'),
        ];
    }
}
