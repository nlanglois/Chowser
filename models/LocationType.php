<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "LocationType".
 *
 * @property integer $id
 * @property string $locationTypeName
 */
class LocationType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'LocationType';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['locationTypeName'], 'required'],
            [['locationTypeName'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'locationTypeName' => 'Location Type Name',
        ];
    }
}
