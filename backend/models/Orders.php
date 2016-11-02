<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property integer $id
 * @property string $order_code
 * @property double $amount
 * @property string $creation_date
 * @property double $paidAmount
 * @property integer $closed
 * @property string $closure_date
 * @property string $last_payment_date
 * @property string $venueName
 * @property string $venueImage
 * @property integer $venue_id
 * @property string $table
 * @property string $paymob_ref
 *
 * @property Venues $venue
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_code', 'amount', 'creation_date', 'closed', 'venueName', 'venueImage', 'table', 'paymob_ref'], 'required'],
            [['amount', 'paidAmount'], 'number'],
            [['creation_date', 'closure_date', 'last_payment_date'], 'safe'],
            [['closed', 'venue_id'], 'integer'],
            [['order_code'], 'string', 'max' => 250],
            [['venueName', 'paymob_ref'], 'string', 'max' => 100],
            [['venueImage'], 'string', 'max' => 200],
            [['table'], 'string', 'max' => 30],
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
            'order_code' => Yii::t('app', 'Order Code'),
            'amount' => Yii::t('app', 'Amount'),
            'creation_date' => Yii::t('app', 'Creation Date'),
            'paidAmount' => Yii::t('app', 'Paid Amount'),
            'closed' => Yii::t('app', 'Closed'),
            'closure_date' => Yii::t('app', 'Closure Date'),
            'last_payment_date' => Yii::t('app', 'Last Payment Date'),
            'venueName' => Yii::t('app', 'Venue Name'),
            'venueImage' => Yii::t('app', 'Venue Image'),
            'venue_id' => Yii::t('app', 'Venue ID'),
            'table' => Yii::t('app', 'Table'),
            'paymob_ref' => Yii::t('app', 'Paymob Ref'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVenue()
    {
        return $this->hasOne(Venues::className(), ['id' => 'venue_id']);
    }
}
