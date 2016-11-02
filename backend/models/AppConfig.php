<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "app_config".
 *
 * @property integer $id
 * @property string $key
 * @property string $value
 */
class AppConfig extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'app_config';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key', 'value'], 'required'],
            [['value'], 'string'],
            [['key'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'key' => Yii::t('app', 'Key'),
            'value' => Yii::t('app', 'Value'),
        ];
    }
}
