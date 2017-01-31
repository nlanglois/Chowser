<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Meal;

/**
 * MealSearch represents the model behind the search form about `app\models\Meal`.
 * @property string $RestaurantName
 * @property string $MealType
 */
class MealSearch extends Meal
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'restID', 'mealTypeID'], 'integer'],
            [['Name', 'Description', 'RestaurantName', 'MealType'], 'safe'],
            [['Price'], 'number'],
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
        $query = Meal::find();
        $query->joinWith(['restaurant']);
        $query->joinWith(['mealType']);
        $query->joinWith(['meat']);


        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);


        // Important: this is where we set up the sorting for the restaurant.name attribute
        // The key is the attribute name on our "MealSearch" instance
        $dataProvider->sort->attributes['RestaurantName'] = [
            // The tables are the ones our relation are configured to
            'asc' => ['Restaurant.name' => SORT_ASC],
            'desc' => ['Restaurant.name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['MealType'] = [
            // The tables are the ones our relation are configured to
            'asc' => ['MealType.mealTypeName' => SORT_ASC],
            'desc' => ['MealType.mealTypeName' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['Meat'] = [
            // The tables are the ones our relation are configured to
            'asc' => ['Meat.name' => SORT_ASC],
            'desc' => ['Meat.name' => SORT_DESC],
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
            'Price' => $this->Price,
            'restID' => $this->restID,
            'mealTypeID' => $this->mealType,
            'meatID' => $this->meatID,
        ]);

        $query->andFilterWhere(['like', 'Name', $this->Name])
            ->andFilterWhere(['like', 'Description', $this->Description])
            ->andFilterWhere(['like', 'Restaurant.name', $this->RestaurantName])
        ;


        return $dataProvider;
    }
}
