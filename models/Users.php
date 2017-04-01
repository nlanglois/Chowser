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

    public $authKey;


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
            'fName' => 'First name',
            'lName' => 'Last name',
            'city' => 'City',
            'state' => 'State',
            'password' => 'Password',
            'status' => 'Status',
        ];
    }




    public static function findIdentity($id){
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null){
        throw new NotSupportedException();  //I don't implement this method because I don't have any access token column in the database
    }

    public function getId(){
        return $this->id;
    }

    public function getAuthKey(){
        return $this->authKey;  //Here I could return a value of my authKey column
    }

    public function validateAuthKey($authKey){
        return $this->authKey === $authKey;
    }

    public static function findByUsername($username){
        return self::findOne(['username'=>$username]);
    }

    public function validatePassword($password){
        return $this->password === $password;
    }


}
