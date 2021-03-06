<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Restaurant;

/**
 * RestaurantSearch represents the model behind the search form about `app\models\Restaurant`.
 */
class RestaurantSearch extends Restaurant
{

    public $fullAddress;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'zip', 'locationTypeID'], 'integer'],
            [['name', 'street1', 'street2', 'fullAddress', 'city', 'state'], 'safe'],
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
        $query = Restaurant::find();
        $query->joinWith(['locationType']);



        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'name' => SORT_ASC,
                ],
            ],
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $dataProvider->sort->attributes['locationName'] = [
            //The tables are the ones our relation are configured to
            'asc' => ['LocationType.locationTypeName' => SORT_ASC],
            'desc' => ['LocationType.locationTypeName' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['fullAddress'] = [
            'asc' => ['Restaurant.street1' => SORT_ASC],
            'desc' => ['Restaurant.street1' => SORT_DESC],
        ];


        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'zip' => $this->zip,
            'locationTypeID' => $this->locationTypeID,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'street1', $this->fullAddress])
            ->andFilterWhere(['like', 'street2', $this->street2])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'state', $this->state]);

        return $dataProvider;
    }
}
