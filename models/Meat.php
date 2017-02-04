<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Meat".
 *
 * @property integer $id
 * @property string $name
 */
class Meat extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Meat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required', 'message'=>"Please enter type of meat"],
            [['name'], 'string', 'max' => 25],
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
        ];
    }

}
