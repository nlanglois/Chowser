<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "AccessLog".
 *
 * @property integer $id
 * @property string $username
 * @property integer $userId
 * @property string $accessDate
 */
class AccessLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'AccessLog';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'accessDate'], 'required'],
            [['userId'], 'integer'],
            [['accessDate'], 'safe'],
            [['username'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'userId' => 'User ID',
            'accessDate' => 'Access Date',
        ];
    }
}
