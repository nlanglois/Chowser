<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "RestaurantReview".
 *
 * @property integer $id
 * @property string $dateCreated
 * @property string $lastModified
 * @property string $title
 * @property string $review
 * @property string $rating
 * @property integer $restaurantId
 */
class RestaurantReview extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'RestaurantReview';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dateCreated', 'lastModified', 'title', 'review', 'rating', 'restaurantId'], 'required'],
            [['dateCreated', 'lastModified'], 'safe'],
            [['review'], 'string'],
            [['rating'], 'number'],
            [['restaurantId'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dateCreated' => 'Date Created',
            'lastModified' => 'Last Modified',
            'title' => 'Title',
            'review' => 'Review',
            'rating' => 'Rating',
            'restaurantId' => 'Restaurant ID',
        ];
    }
}
