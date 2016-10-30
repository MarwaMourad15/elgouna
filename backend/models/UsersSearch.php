<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Users;

/**
 * UsersSearch represents the model behind the search form about `backend\models\Users`.
 */
class UsersSearch extends Users
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'gender', 'notificationsEnabled', 'mapsEnabled'], 'integer'],
            [['userAuth', 'name', 'imageURL', 'phoneNumber', 'birthDate', 'address', 'email', 'zipCode', 'elgounaPhone', 'elgounaSMS', 'elgounaemail', 'fbId', 'ehgzly_user_token', 'ehgzly_user_id', 'auth_reset_token'], 'safe'],
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
        $query = Users::find();

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
            'gender' => $this->gender,
            'notificationsEnabled' => $this->notificationsEnabled,
            'mapsEnabled' => $this->mapsEnabled,
        ]);

        $query->andFilterWhere(['like', 'userAuth', $this->userAuth])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'imageURL', $this->imageURL])
            ->andFilterWhere(['like', 'phoneNumber', $this->phoneNumber])
            ->andFilterWhere(['like', 'birthDate', $this->birthDate])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'zipCode', $this->zipCode])
            ->andFilterWhere(['like', 'elgounaPhone', $this->elgounaPhone])
            ->andFilterWhere(['like', 'elgounaSMS', $this->elgounaSMS])
            ->andFilterWhere(['like', 'elgounaemail', $this->elgounaemail])
            ->andFilterWhere(['like', 'fbId', $this->fbId])
            ->andFilterWhere(['like', 'ehgzly_user_token', $this->ehgzly_user_token])
            ->andFilterWhere(['like', 'ehgzly_user_id', $this->ehgzly_user_id])
            ->andFilterWhere(['like', 'auth_reset_token', $this->auth_reset_token]);

        return $dataProvider;
    }
}
