<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "weather".
 *
 * @property integer $id
 * @property string $date
 * @property string $cloudCover
 * @property string $feelsLike
 * @property string $humidity
 * @property string $pressure
 * @property string $temperature
 * @property string $windDirection
 * @property string $windSpeed
 * @property string $high
 * @property string $low
 * @property string $weatherDesc
 * @property string $chanceofFog
 * @property string $chanceOfRain
 * @property string $chanceOfSnow
 * @property string $sunrise
 * @property string $sunset
 */
class Weather extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'weather';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'cloudCover', 'feelsLike', 'humidity', 'pressure', 'temperature', 'windDirection', 'windSpeed', 'high', 'low', 'weatherDesc', 'chanceofFog', 'chanceOfRain', 'chanceOfSnow', 'sunrise', 'sunset'], 'required'],
            [['date'], 'safe'],
            [['cloudCover', 'feelsLike', 'humidity', 'pressure', 'temperature', 'windDirection', 'windSpeed', 'high', 'low', 'weatherDesc', 'chanceofFog', 'chanceOfRain', 'chanceOfSnow', 'sunrise', 'sunset'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'date' => Yii::t('app', 'Date'),
            'cloudCover' => Yii::t('app', 'Cloud Cover'),
            'feelsLike' => Yii::t('app', 'Feels Like'),
            'humidity' => Yii::t('app', 'Humidity'),
            'pressure' => Yii::t('app', 'Pressure'),
            'temperature' => Yii::t('app', 'Temperature'),
            'windDirection' => Yii::t('app', 'Wind Direction'),
            'windSpeed' => Yii::t('app', 'Wind Speed'),
            'high' => Yii::t('app', 'High'),
            'low' => Yii::t('app', 'Low'),
            'weatherDesc' => Yii::t('app', 'Weather Desc'),
            'chanceofFog' => Yii::t('app', 'Chanceof Fog'),
            'chanceOfRain' => Yii::t('app', 'Chance Of Rain'),
            'chanceOfSnow' => Yii::t('app', 'Chance Of Snow'),
            'sunrise' => Yii::t('app', 'Sunrise'),
            'sunset' => Yii::t('app', 'Sunset'),
        ];
    }
}
