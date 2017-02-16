<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "Meal".
 *
 * @property integer $id
 * @property string $Name
 * @property string $Description
 * @property string $Price
 * @property integer $restID
 * @property integer $mealTypeID
 * @property integer $meatID
 */
class Meal extends \yii\db\ActiveRecord
{

    public $RestaurantName;
    public $MealType;
    public $upload_file;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Meal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Name'], 'required', 'message' => 'What is the name of the meal?'],
            [['Description'], 'required', 'message' => 'How would you describe this meal?'],
            [['Price'], 'required',  'message' => 'How much did you pay for this meal?'],
            [['Price'], 'number'],
            [['restID'], 'required',  'message' => 'Which restaurant did you eat this meal at?'],
            [['mealTypeID'], 'required',  'message' => 'What type of meal is this?'],
            [['meatID'], 'required',  'message' => 'What meat was in this meal?'],
            [['restID', 'mealTypeID', 'meatID'], 'integer'],
            [['upload_file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'jpg, png, jpeg', 'mimeTypes' => 'image/jpeg, image/png',],
            [['Name'], 'string', 'max' => 100],
            [['Description'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Name' => 'Meal name',
            'Description' => 'Description',
            'Price' => 'Price',
            'restID' => 'Restaurant ID',
            'RestaurantName' => 'Name of restaurant',
            'restaurant.name' => 'Name of restaurant',
            'mealTypeID' => 'Meal type ID',
            'MealType' => 'Meal type',
            'mealType.mealTypeName' => 'Meal type',
            'meatID' => 'Meat',
            'meat.name' => 'Meat',
            "Meat" => 'Meat',
            'upload_file' => 'Upload photo',
        ];
    }


    /**
     * @return bool|UploadedFile
     * Handles obtaining file object selected in form
     */
    public function uploadFile() {
        // get the uploaded file instance
        $image = UploadedFile::getInstance($this, 'upload_file');

        // if no image was uploaded abort the upload
        if (empty($image)) {
            return false;
        }

        // generate new name for the file
        $this->photo = time() . '.' . $image->extension;

        // the uploaded image instance
        return $image;
    }



    /**
     * @return string
     * Returns the restaurant's photo url if one is set, else returns default image
     */
    public function getUploadedFilePath() {
        // return a default image placeholder if your restaurant photo is not found
        $photo = isset($this->photo) ? $this->photo : 'generic.png';
        return Yii::$app->params['mealFileUploadUrl'] . $photo;
    }


    public function getUploadedFileName() {
        return $this->photo;
    }



    public function hasPhoto() {
        return isset($this->photo) ? true : false;
    }



    /* Getter to return the name of the restaurant the meal can be found at */
    /* Essentially this is a relation method for this particular attribute, in this case, restID */
    public function getRestaurant()
    {
        return $this->hasOne(Restaurant::className(), ['id' => 'restID']);
    }


    public function getMealType()
    {
        return $this->hasOne(MealType::className(), ['id' => 'mealTypeID']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMeat()
    {
        return $this->hasOne(Meat::className(), ['id' => 'meatID']);
    }

}
