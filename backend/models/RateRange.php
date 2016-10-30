<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "rate_range".
 *
 * @property integer $id
 * @property integer $start
 * @property integer $end
 * @property string $title
 */
class RateRange extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rate_range';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['start', 'end', 'title'], 'required'],
            [['start', 'end'], 'integer'],
            [['title'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'start' => Yii::t('app', 'Start'),
            'end' => Yii::t('app', 'End'),
            'title' => Yii::t('app', 'Title'),
        ];
    }
}
