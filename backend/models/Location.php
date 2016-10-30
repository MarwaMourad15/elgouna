<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "location".
 *
 * @property integer $id
 * @property string $title
 * @property integer $ordering
 */
class Location extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'location';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ordering'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'ordering' => Yii::t('app', 'Ordering'),
        ];
    }
}
