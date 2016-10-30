<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Settings;

/**
 * SettingsSearch represents the model behind the search form about `backend\models\Settings`.
 */
class SettingsSearch extends Settings
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['bookingURL', 'facebookURL', 'elgounaURL', 'twitterURL', 'youtubeURL', 'instagramURL', 'snapchatURL', 'elgounaPhone', 'elgounaSMS', 'elgounaemail', 'about', 'paymobAPIKey', 'paymobSecretKey', 'paymobMerchantId', 'paymobSecureHash'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Settings::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'bookingURL', $this->bookingURL])
            ->andFilterWhere(['like', 'facebookURL', $this->facebookURL])
            ->andFilterWhere(['like', 'elgounaURL', $this->elgounaURL])
            ->andFilterWhere(['like', 'twitterURL', $this->twitterURL])
            ->andFilterWhere(['like', 'youtubeURL', $this->youtubeURL])
            ->andFilterWhere(['like', 'instagramURL', $this->instagramURL])
            ->andFilterWhere(['like', 'snapchatURL', $this->snapchatURL])
            ->andFilterWhere(['like', 'elgounaPhone', $this->elgounaPhone])
            ->andFilterWhere(['like', 'elgounaSMS', $this->elgounaSMS])
            ->andFilterWhere(['like', 'elgounaemail', $this->elgounaemail])
            ->andFilterWhere(['like', 'about', $this->about])
            ->andFilterWhere(['like', 'paymobAPIKey', $this->paymobAPIKey])
            ->andFilterWhere(['like', 'paymobSecretKey', $this->paymobSecretKey])
            ->andFilterWhere(['like', 'paymobMerchantId', $this->paymobMerchantId])
            ->andFilterWhere(['like', 'paymobSecureHash', $this->paymobSecureHash]);

        return $dataProvider;
    }
}
