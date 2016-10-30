<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "beaches_filter".
 *
 * @property integer $id
 * @property string $name
 * @property string $query
 * @property integer $ord
 */
class BeachesFilter extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'beaches_filter';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'query', 'ord'], 'required'],
            [['name', 'query'], 'string'],
            [['ord'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'query' => Yii::t('app', 'Query'),
            'ord' => Yii::t('app', 'Ord'),
        ];
    }
}
