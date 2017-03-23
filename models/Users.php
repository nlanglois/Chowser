<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "User".
 *
 * @property integer $id
 * @property string $fName
 * @property string $lName
 * @property string $city
 * @property string $state
 * @property string $password
 * @property integer $status
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'User';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fName', 'lName', 'password', 'status'], 'required'],
            [['status'], 'integer'],
            [['fName', 'lName', 'city', 'password'], 'string', 'max' => 250],
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
            'fName' => 'F Name',
            'lName' => 'L Name',
            'city' => 'City',
            'state' => 'State',
            'password' => 'Password',
            'status' => 'Status',
        ];
    }
}
