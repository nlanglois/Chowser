<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "RestaurantHours".
 *
 * @property integer $id
 * @property integer $restId
 * @property string $dayOfWeek
 * @property string $open
 * @property string $close
 */
class RestaurantHours extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'RestaurantHours';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dayOfWeek', 'open', 'close'], 'required', 'message' => 'Required'],
            [['restId'], 'integer'],
            [['restId'], 'safe'],
            [['dayOfWeek', 'open', 'close'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'restId' => 'Rest ID',
            'dayOfWeek' => 'Day Of Week',
            'open' => 'Opens',
            'close' => 'Closes',
        ];
    }
}
