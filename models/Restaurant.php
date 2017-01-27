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

    public $mealTypes;

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
            [['zip'], 'integer'],
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
        ];
    }

}
