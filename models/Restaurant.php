<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Restaurant".
 *
 * @property integer $id
 * @property string $name
 * @property string $street1
 * @property string $street2
 * @property string $city
 * @property string $state
 * @property integer $zip
 */
class Restaurant extends \yii\db\ActiveRecord
{

    //public $mealTypes;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Restaurant';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'street1', 'city', 'zip'], 'required'],
            [['zip', 'locationTypeID'], 'integer'],
            [['name', 'street1', 'street2', 'city'], 'string', 'max' => 100],
            [['state'], 'string', 'max' => 2],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'street1' => 'Street1',
            'street2' => 'Street2',
            'city' => 'City',
            'state' => 'State',
            'zip' => 'Zip',
            'mealTypes' => 'Types of meals served here',
            'locationTypeID' => 'Type of Location'
        ];
    }


    /*
     * One-to-many getter to retrieve the attributes of the LocationType model from locationTypeID foreign key in Restaurant model
     */
    public function getLocationType()
    {
        return $this->hasOne(LocationType::className(), ['id' => 'locationTypeID']);
    }



    /*
     * Many-to-many getter to retrieve the attributes of MealType model from RestMealTypeLT linking table
     */

    public function getMealTypes()
    {
        return $this->hasMany(MealType::className(), ['id' => 'mealTypeID'])
            ->viaTable('RestMealTypeLT', ['restID' => 'id']);
    }


    /*
     * Another way of writing the above M2M getter:
     * See: http://www.yiiframework.com/doc-2.0/guide-db-active-record.html#relational-data
     */
    /*
    public function getRestaurantMeals()
    {
        return $this->hasMany(RestMealTypeLT::className(), ['restID' => 'id']);
    }

    public function getMealTypes()
    {
        return $this->hasMany(MealType::className(), ['id' => 'mealTypeID'])
            ->via('restaurantMeals');
    }
    */

}
