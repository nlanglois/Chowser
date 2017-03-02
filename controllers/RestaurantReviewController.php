<?php

namespace app\controllers;

use app\models\Restaurant;
use Yii;
use yii\web\Controller;
use app\models\RestaurantReview;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class RestaurantReviewController extends Controller
{


    public $layout = "blank";



    public function actionNew($restaurantId)
    {

        $restaurant = Restaurant::findOne($restaurantId);
        $restaurantReview = new RestaurantReview();


        if ($restaurantReview->load(Yii::$app->request->post()) && $restaurantReview->save()) {

            //redirect to some sort of like thank you or success page for when the RR is logged
            //return $this->redirect(['view', 'id' => $model->id]);
            return "Thank you for your restaurant review!";

        } else {

            return $this->render('new', [
                'model' => $restaurantReview,
                'restaurant' => $restaurant,
                'restaurantID' => $restaurantId,
            ]);

        }

    }





    public function actionShowAll($id)
    {
        $queryRestaurantReviews = new ActiveDataProvider([
            'query' => RestaurantReview::find()->where(['restaurantId' => $id]),
        ]);
        return $this->render('show-all', [
            'model' => $this->findModel($id),
            'restaurantReview' => $queryRestaurantReviews,
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
