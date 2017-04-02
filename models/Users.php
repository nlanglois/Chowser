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
class Users extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
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
            [['fName', 'lName', 'city', 'email', 'password'], 'string', 'max' => 255],
            [
                [
                    'password',
                ],
                'match',
                'pattern'=>'$\S*(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$',
                'message'=>'Password must have at least 1 uppercase and 1 number.',
            ],
            [
                [
                    'password',
                ],
                'string',
                'min' => 6,
            ],
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
            'fName' => 'First name',
            'lName' => 'Last name',
            'city' => 'City',
            'state' => 'State',
            'password' => 'Password',
            'status' => 'Status',
        ];
    }





    public function getAuthKey() {
        return static::findOne('AuthKey');
    }

    public function validateAuthKey($authKey) {
        return static::findOne(['AuthKey' => $authKey]);
    }


    public function getId() {
        return $this->id;
    }

    public static function findIdentity($id) {
        return self::findOne($id);
    }


    public static function findIdentityByAccessToken($token, $type = null) {
        return self::findOne(['access_token'=>$token]);
    }

    public static function findByUsername($username){
        return self::findOne(['username' => $username]);
    }

    public function validatePassword($password) {
        // return $this->password_hash === $password;

        return Yii::$app->getSecurity()->validatePassword(
            $password,
            \Yii::$app->security->generatePasswordHash($password)
        );

        // return $this->password === md5($password);
    }

}
