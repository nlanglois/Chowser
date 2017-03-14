<?php

namespace app\controllers;

use app\models\Restaurant;
use Yii;
use yii\web\Controller;
use app\models\RestaurantReview;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\helpers\Json;

class RestaurantReviewController extends Controller
{


    public $layout = "blank";



    public function actionNew($restaurantId)
    {

        $restaurant = Restaurant::findOne($restaurantId);
        $restaurantReview = new RestaurantReview();


        if ($restaurantReview->load(Yii::$app->request->post()) && $restaurantReview->save()) {
            //redirect to some sort of like thank you or success page for when the RR is logged
            return $this->render('thank-you', [
                'restaurant' => $restaurant,
            ]);

        } else {
            return $this->render('new', [
                'model' => $restaurantReview,
                'restaurant' => $restaurant,
                'restaurantID' => $restaurantId,
            ]);

        }

    }





    public function actionShowAll($restaurantId)
    {
        $allRestaurantReviews = RestaurantReview::find()
            ->where(['restaurantId' => $restaurantId])
            ->all();

        $restaurantDetails = Restaurant::find()
            ->where(['id' => $restaurantId])
            ->one();


        return $this->render('show-all', [
            'restaurant' => $restaurantDetails,
            'reviews' => $allRestaurantReviews,
        ]);


    }




    protected function findModel($id)
    {
        if (($model = RestaurantReview::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
