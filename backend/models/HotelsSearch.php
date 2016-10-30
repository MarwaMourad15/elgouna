<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Hotels;

/**
 * HotelsSearch represents the model behind the search form about `backend\models\Hotels`.
 */
class HotelsSearch extends Hotels
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'ratingStar', 'offerExists', 'isPoolAvailable', 'isGymAvailable', 'isWifiAvailable', 'isVisaPaymentAvailable', 'isDiningInAvailable', 'pid', 'ord', 'hidden'], 'integer'],
            [['name', 'location', 'longitude', 'latitude', 'bookingLink', 'descrip', 'offerTitle', 'offerDescription', 'accomadtionType', 'elgounaVoice', 'email', 'phoneNumber', 'info', 'facebookLink', 'twitterLink', 'instagramLink', 'youtubeLink', 'virtualTourLink'], 'safe'],
            [['reviewScore'], 'number'],
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
        $query = Hotels::find();

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
            'reviewScore' => $this->reviewScore,
            'ratingStar' => $this->ratingStar,
            'offerExists' => $this->offerExists,
            'isPoolAvailable' => $this->isPoolAvailable,
            'isGymAvailable' => $this->isGymAvailable,
            'isWifiAvailable' => $this->isWifiAvailable,
            'isVisaPaymentAvailable' => $this->isVisaPaymentAvailable,
            'isDiningInAvailable' => $this->isDiningInAvailable,
            'pid' => $this->pid,
            'ord' => $this->ord,
            'hidden' => $this->hidden,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'location', $this->location])
            ->andFilterWhere(['like', 'longitude', $this->longitude])
            ->andFilterWhere(['like', 'latitude', $this->latitude])
            ->andFilterWhere(['like', 'bookingLink', $this->bookingLink])
            ->andFilterWhere(['like', 'descrip', $this->descrip])
            ->andFilterWhere(['like', 'offerTitle', $this->offerTitle])
            ->andFilterWhere(['like', 'offerDescription', $this->offerDescription])
            ->andFilterWhere(['like', 'accomadtionType', $this->accomadtionType])
            ->andFilterWhere(['like', 'elgounaVoice', $this->elgounaVoice])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'phoneNumber', $this->phoneNumber])
            ->andFilterWhere(['like', 'info', $this->info])
            ->andFilterWhere(['like', 'facebookLink', $this->facebookLink])
            ->andFilterWhere(['like', 'twitterLink', $this->twitterLink])
            ->andFilterWhere(['like', 'instagramLink', $this->instagramLink])
            ->andFilterWhere(['like', 'youtubeLink', $this->youtubeLink])
            ->andFilterWhere(['like', 'virtualTourLink', $this->virtualTourLink]);

        return $dataProvider;
    }
}
