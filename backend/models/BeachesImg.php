<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "beaches_img".
 *
 * @property integer $id
 * @property integer $beach_id
 * @property string $img
 */
class BeachesImg extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'beaches_img';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['beach_id', 'img'], 'required'],
            [['beach_id'], 'integer'],
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
            'beach_id' => Yii::t('app', 'Beach ID'),
            'img' => Yii::t('app', 'Img'),
        ];
    }

    public function getBeach()
    {
        return $this->hasOne(Beaches::className(), ['id' => 'beach_id']);
    }


    public static function getImgs($beach_id)
    {
        $_json = array();
        $images = BeachesImg::find()
            ->where(['beach_id' => $beach_id ])
            ->all();
        foreach ($images as $img) {
            $_img = $img['img'];
            $_json[] = $_img;
        }
        return $_json;
    }
}
