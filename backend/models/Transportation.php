<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "transportation".
 *
 * @property integer $id
 * @property string $type
 * @property string $description
 * @property string $img
 */
class Transportation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transportation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'description', 'img'], 'required'],
            [['description'], 'string'],
            [['type'], 'string', 'max' => 50],
            [['img'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'type' => Yii::t('app', 'Type'),
            'description' => Yii::t('app', 'Description'),
            'img' => Yii::t('app', 'Img'),
        ];
    }
}
