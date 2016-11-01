<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "venues_img".
 *
 * @property integer $id
 * @property integer $venue_id
 * @property string $img
 *
 * @property Venues $venue
 */
class VenuesImg extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'venues_img';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['venue_id', 'img'], 'required'],
            [['venue_id'], 'integer'],
            [['img'], 'string', 'max' => 500],
            [['venue_id'], 'exist', 'skipOnError' => true, 'targetClass' => Venues::className(), 'targetAttribute' => ['venue_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'venue_id' => Yii::t('app', 'Venue ID'),
            'img' => Yii::t('app', 'Img'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVenue()
    {
        return $this->hasOne(Venues::className(), ['id' => 'venue_id']);
    }

    public static function getVenueImg($venue_id)
    {
        $venue_json = array();
        $images = VenuesImg::find()
            ->where(['venue_id' => $venue_id ])
            ->all();
        foreach ($images as $img) {
            $venue_img = $img['img'];
            $venue_json[] = $venue_img;
        }
        return $venue_json;
    }

    public static function getVenueOneImg($venue_id)
    {
        $img = VenuesImg::find()
            ->where(['venue_id' => $venue_id ])
            ->one();
        $venue_img = $img['img'];

        return $venue_img;
    }
}
