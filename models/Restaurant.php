<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use yii\db\ActiveRecord;
use yii\helpers\VarDumper;



/**
 * This is the model class for table "Restaurant".
 *
 * @property integer $id
 * @property string $name
 * @property string $street1
 * @property string $street2
 * @property string $fullAddress
 * @property string $city
 * @property string $state
 * @property integer $zip
 * @property string $coordinates
 * @property integer $locationTypeID
 * @property string $photo
 * @property string $status
 */
class Restaurant extends ActiveRecord
{

    public $mealTypes_field;
    public $upload_file;

    public $restaurantHours;



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
            [
                [
                    'description',
                    'street1',
                    'city',
                    'state',
                    'zip',
                    'status',
                ], 'required',
            ],

            [
                [
                    'locationTypeID',
                ], 'integer',
            ],

            [
                [
                    'zip',
                ], 'match',
                'pattern' => '/^\d{5}?$/',
                'message' => 'Please enter a 5 digit numerical zip code.'
            ],

            [
                [
                    'name',
                ], 'required',
                'message' => 'Please enter the name of this restaurant.',
            ],

            [
                [
                    'locationTypeID',
                ], 'required',
                'message' => 'What type of restaurant is this?',
            ],

            [
                [
                    'mealTypes_field',
                ], 'required',
                'message' => 'You must select at least one type of meal.',
            ],

            [
                [
                    'upload_file'
                ], 'file',
                'skipOnEmpty' => true,
                'extensions' => 'jpg, png, jpeg',
                'mimeTypes' => 'image/jpeg, image/png',
            ],

            [
                [
                    'name',
                    'street1',
                    'street2',
                    'city',
                ], 'string',
                'max' => 100,
            ],

            [
                [
                    'state',
                ], 'string',
                'max' => 2,
            ],

            [
                [
                    'mealTypes_field',
                    'upload_file',
                    'coordinates',

                    'restId',
                    'dayOfWeek',
                    'open',
                    'close',

                ], 'safe',
            ],

            [
                [
                    'description',
                ], 'string',
                'skipOnEmpty' => true,
            ]

        ];
    }



    public function afterSave($insert, $changedAttributes)
    {

        /* Handles the M2M relationships between Restaurant and MealTypes */
        // Delete existing relationships
        \Yii::$app->db
            ->createCommand()
            ->delete('RestMealTypeLT', 'restID = ' . (int)$this->id)
            ->execute();

        // Now write each relationship defined by the checked checkboxes back to the linking table
        foreach ($this->mealTypes_field as $id) { // Write new values
            $restMealType = new RestMealTypeLT();
            $restMealType->restID = $this->id;
            $restMealType->mealTypeID = $id;
            $restMealType->save();
        }



        /* Handles the One2M relationships between Restaurant and RestaurantHours */
        // Delete existing relationships
        \Yii::$app->db
            ->createCommand()
            ->delete('RestaurantHours', 'restId = ' . (int)$this->id)
            ->execute();

        // Now, create each of the new rows in RestaurantHours as defined by drop-down menus on views/restaurant/_form
        $count = 0;

        //echo VarDumper::dumpAsString($_POST['RestaurantHours'], 10, true);
        //die("There are " . count($_POST['RestaurantHours']) . " restaurant hours records.");

        //foreach($_POST['RestaurantHours'] as $key => $array)
        for($r=0; $r < count($_POST['RestaurantHours']['restId']); $r++)
        {
            $restaurantHours = new RestaurantHours();
            $restaurantHours->restId = $this->id;
            $restaurantHours->dayOfWeek = $_POST['RestaurantHours']['dayOfWeek'][$count];
            $restaurantHours->open = $_POST['RestaurantHours']['open'][$count];
            $restaurantHours->close = $_POST['RestaurantHours']['close'][$count];
            $restaurantHours->save();

            $count++;
        }

    }





    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'street1' => 'Street 1',
            'street2' => 'Street 2',
            'city' => 'City',
            'state' => 'State',
            'zip' => 'Zip code',
            'coordinates' => 'Coordinates',
            'mealTypes_field' => 'Types of meals served here',
            'locationTypeID' => 'Location ID',
            'locationType.locationTypeName' => 'Location type',
            'locationName' => 'Type',
            'upload_file' => 'Upload photo',
            'description' => 'Description',
            'status' => 'Live?',
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
        return Yii::$app->params['restaurantFileUploadUrl'] . $photo;
    }


    public function getUploadedFileName() {
        return $this->photo;
    }



    public function hasPhoto() {
        return isset($this->photo) ? true : false;
    }


    /*
     * One-to-many getter to retrieve the attributes of the LocationType model from locationTypeID foreign key in Restaurant model
     */
    public function getLocationType()
    {
        return $this->hasOne(LocationType::className(), ['id' => 'locationTypeID']);
    }



    /*
     * Many-to-many getter to retrieve the attributes of MealType model from RestMealTypeLT linking table
     */
    /*
    public function getMealTypes()
    {
        return $this->hasMany(MealType::className(), ['id' => 'mealTypeID'])
            ->viaTable('RestMealTypeLT', ['restID' => 'id']);
    }
    */

    /*
     * Another way of writing the above M2M getter:
     * See: http://www.yiiframework.com/doc-2.0/guide-db-active-record.html#relational-data
     */
    public function getRestaurantMeals()
    {
        return $this->hasMany(RestMealTypeLT::className(), ['restID' => 'id']);
    }





    public function getMealTypes()
    {
        return $this->hasMany(MealType::className(), ['id' => 'mealTypeID'])
            ->via('restaurantMeals');
    }





    static public function getOperationHours($restId)
    {
        $restaurantHours = \app\models\RestaurantHours::find()
            ->select('dayOfWeek, open, close')
            ->where(['restId' => $restId])
            ->orderBy('id')
            ->asArray()
            ->all();

        //print "<pre>";
        //return print_r($restaurantHours);
        //print "</pre>";



        $output = "<table class='restHours'>";

            $output .= "<tr>";
                $output .= "<th>Day</th>";
                $output .= "<th>Opens</th>";
                $output .= "<th>Closes</th>";
            $output .= "</tr>";

        foreach($restaurantHours as $key => $dayOfWeekArray)
        {
            $output .= "<tr>";
                foreach($dayOfWeekArray as $key => $value)
                {
                    $output .= "<td>" . $value . "</td>";
                }
            $output .= "</tr>";
        }
        $output .= "</table>";

        return $output;

    }


}
