<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Weather;

/**
 * WeatherSearch represents the model behind the search form about `backend\models\Weather`.
 */
class WeatherSearch extends Weather
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['date', 'cloudCover', 'feelsLike', 'humidity', 'pressure', 'temperature', 'windDirection', 'windSpeed', 'high', 'low', 'weatherDesc', 'chanceofFog', 'chanceOfRain', 'chanceOfSnow', 'sunrise', 'sunset'], 'safe'],
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
        $query = Weather::find();

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
            'date' => $this->date,
        ]);

        $query->andFilterWhere(['like', 'cloudCover', $this->cloudCover])
            ->andFilterWhere(['like', 'feelsLike', $this->feelsLike])
            ->andFilterWhere(['like', 'humidity', $this->humidity])
            ->andFilterWhere(['like', 'pressure', $this->pressure])
            ->andFilterWhere(['like', 'temperature', $this->temperature])
            ->andFilterWhere(['like', 'windDirection', $this->windDirection])
            ->andFilterWhere(['like', 'windSpeed', $this->windSpeed])
            ->andFilterWhere(['like', 'high', $this->high])
            ->andFilterWhere(['like', 'low', $this->low])
            ->andFilterWhere(['like', 'weatherDesc', $this->weatherDesc])
            ->andFilterWhere(['like', 'chanceofFog', $this->chanceofFog])
            ->andFilterWhere(['like', 'chanceOfRain', $this->chanceOfRain])
            ->andFilterWhere(['like', 'chanceOfSnow', $this->chanceOfSnow])
            ->andFilterWhere(['like', 'sunrise', $this->sunrise])
            ->andFilterWhere(['like', 'sunset', $this->sunset]);

        return $dataProvider;
    }
}
