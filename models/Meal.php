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
 */
class Meal extends \yii\db\ActiveRecord
{
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
            [['id', 'Name', 'Description', 'Price', 'restID', 'mealTypeID'], 'required'],
            [['id', 'restID', 'mealTypeID'], 'integer'],
            [['Price'], 'number'],
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
            'Name' => 'Name',
            'Description' => 'Description',
            'Price' => 'Price',
            'restID' => 'Rest ID',
            'mealTypeID' => 'Meal Type ID',
        ];
    }
}
