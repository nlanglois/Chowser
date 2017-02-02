<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "RestMealTypeLT".
 *
 * @property integer $id
 * @property integer $restID
 * @property integer $mealTypeID
 */
class RestMealTypeLT extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'RestMealTypeLT';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['restID', 'mealTypeID'], 'required'],
            [['restID', 'mealTypeID'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'restID' => 'Rest ID',
            'mealTypeID' => 'Meal Type ID',
        ];
    }
}
