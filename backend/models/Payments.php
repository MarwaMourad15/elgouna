<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "payments".
 *
 * @property integer $id
 * @property double $amount
 * @property string $payment_date
 * @property string $card_ending_with
 * @property string $venue_name
 * @property string $paymob_ref
 * @property integer $user_id
 * @property integer $order_id
 */
class Payments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['amount', 'payment_date', 'card_ending_with', 'venue_name', 'paymob_ref', 'user_id', 'order_id'], 'required'],
            [['amount'], 'number'],
            [['payment_date'], 'safe'],
            [['user_id', 'order_id'], 'integer'],
            [['card_ending_with'], 'string', 'max' => 4],
            [['venue_name'], 'string', 'max' => 100],
            [['paymob_ref'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'amount' => Yii::t('app', 'Amount'),
            'payment_date' => Yii::t('app', 'Payment Date'),
            'card_ending_with' => Yii::t('app', 'Card Ending With'),
            'venue_name' => Yii::t('app', 'Venue Name'),
            'paymob_ref' => Yii::t('app', 'Paymob Ref'),
            'user_id' => Yii::t('app', 'User ID'),
            'order_id' => Yii::t('app', 'Order ID'),
        ];
    }
}
