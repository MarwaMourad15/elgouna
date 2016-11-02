<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Venues;

/**
 * VenuesSearch represents the model behind the search form about `backend\models\Venues`.
 */
class VenuesSearch extends Venues
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'ratingStar', 'offerCheck', 'wifiCheck', 'visaCheck', 'diningCheck', 'ord', 'category_id', 'price_type', 'popularity', 'location_id', 'place_type', 'category_type', 'taste', 'cleanliness', 'rating'], 'integer'],
            [['venueUsername', 'venuePass', 'name', 'type', 'location', 'longitude', 'latitude', 'description', 'offerTitle', 'offerDescription', 'elgounaVoice', 'email', 'phoneNumber', 'info', 'facebookLink', 'twitterLink', 'instagramLink', 'youtubeLink', 'merchant_id', 'secure_hash'], 'safe'],
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
        $query = Venues::find();

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
            'offerCheck' => $this->offerCheck,
            'wifiCheck' => $this->wifiCheck,
            'visaCheck' => $this->visaCheck,
            'diningCheck' => $this->diningCheck,
            'ord' => $this->ord,
            'category_id' => $this->category_id,
            'price_type' => $this->price_type,
            'popularity' => $this->popularity,
            'location_id' => $this->location_id,
            'place_type' => $this->place_type,
            'category_type' => $this->category_type,
            'taste' => $this->taste,
            'cleanliness' => $this->cleanliness,
            'rating' => $this->rating,
        ]);

        $query->andFilterWhere(['like', 'venueUsername', $this->venueUsername])
            ->andFilterWhere(['like', 'venuePass', $this->venuePass])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'location', $this->location])
            ->andFilterWhere(['like', 'longitude', $this->longitude])
            ->andFilterWhere(['like', 'latitude', $this->latitude])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'offerTitle', $this->offerTitle])
            ->andFilterWhere(['like', 'offerDescription', $this->offerDescription])
            ->andFilterWhere(['like', 'elgounaVoice', $this->elgounaVoice])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'phoneNumber', $this->phoneNumber])
            ->andFilterWhere(['like', 'info', $this->info])
            ->andFilterWhere(['like', 'facebookLink', $this->facebookLink])
            ->andFilterWhere(['like', 'twitterLink', $this->twitterLink])
            ->andFilterWhere(['like', 'instagramLink', $this->instagramLink])
            ->andFilterWhere(['like', 'youtubeLink', $this->youtubeLink])
            ->andFilterWhere(['like', 'merchant_id', $this->merchant_id])
            ->andFilterWhere(['like', 'secure_hash', $this->secure_hash]);

        return $dataProvider;
    }
}
