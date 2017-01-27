<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "MealType".
 *
 * @property integer $id
 * @property string $mealTypeName
 */
class MealType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'MealType';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mealTypeName'], 'required'],
            [['mealTypeName'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'mealTypeName' => 'Meal Type Name',
        ];
    }



    /* Getter returns necessary attributes for all MealType records */
    public static function getMealTypes()
    {
        return MealType::find()->select(['id', 'mealTypeName'])->all();
    }
}
