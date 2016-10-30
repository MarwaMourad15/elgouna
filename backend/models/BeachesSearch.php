<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Beaches;

/**
 * BeachesSearch represents the model behind the search form about `backend\models\Beaches`.
 */
class BeachesSearch extends Beaches
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'ratingStar', 'offerExists', 'isPoolAvailable', 'isGymAvailable', 'isWifiAvailable', 'isVisaPaymentAvailable', 'isDiningInAvailable', 'ord', 'hidden', 'category_id', 'price_type', 'popularity', 'location_id', 'place_type'], 'integer'],
            [['name', 'type', 'location', 'longitude', 'latitude', 'descrip', 'offerTitle', 'offerDescription', 'accomadtionType', 'elgounaVoice', 'email', 'phoneNumber', 'info', 'facebookLink', 'twitterLink', 'instagramLink', 'youtubeLink'], 'safe'],
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
        $query = Beaches::find();

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
            'ord' => $this->ord,
            'hidden' => $this->hidden,
            'category_id' => $this->category_id,
            'price_type' => $this->price_type,
            'popularity' => $this->popularity,
            'location_id' => $this->location_id,
            'place_type' => $this->place_type,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'location', $this->location])
            ->andFilterWhere(['like', 'longitude', $this->longitude])
            ->andFilterWhere(['like', 'latitude', $this->latitude])
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
            ->andFilterWhere(['like', 'youtubeLink', $this->youtubeLink]);

        return $dataProvider;
    }
}
