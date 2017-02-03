<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Meal".
 *
 * @property integer $id
 * @property string $Name
 * @property string $Description
 * @property string $Price
 * @property integer $restID
 * @property integer $mealTypeID
 * @property integer $meatID
 */
class Meal extends \yii\db\ActiveRecord
{

    public $RestaurantName;
    public $MealType;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Meal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Name'], 'required', 'message' => 'What is the name of the meal?'],
            [['Description'], 'required', 'message' => 'How would you describe this meal?'],
            [['Price'], 'required',  'message' => 'How much did you pay for this meal?'],
            [['Price'], 'number'],
            [['restID'], 'required',  'message' => 'Which restaurant did you eat this meal at?'],
            [['mealTypeID'], 'required',  'message' => 'What type of meal is this?'],
            [['meatID'], 'required',  'message' => 'What meat was in this meal?'],
            [['restID', 'mealTypeID', 'meatID'], 'integer'],
            [['Name'], 'string', 'max' => 100],
            [['Description'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Name' => 'Meal name',
            'Description' => 'Description',
            'Price' => 'Price',
            'restID' => 'Restaurant ID',
            'RestaurantName' => 'Name of restaurant',
            'restaurant.name' => 'Name of restaurant',
            'mealTypeID' => 'Meal type ID',
            'MealType' => 'Meal type',
            'mealType.mealTypeName' => 'Meal type',
            'meatID' => 'Meat',
            'meat.name' => 'Meat',
            "Meat" => 'Meat',
        ];
    }






    /* Getter to return the name of the restaurant the meal can be found at */
    /* Essentially this is a relation method for this particular attribute, in this case, restID */
    public function getRestaurant()
    {
        return $this->hasOne(Restaurant::className(), ['id' => 'restID']);
    }


    public function getMealType()
    {
        return $this->hasOne(MealType::className(), ['id' => 'mealTypeID']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMeat()
    {
        return $this->hasOne(Meat::className(), ['id' => 'meatID']);
    }

}
