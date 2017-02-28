<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\RestaurantReview;

class RestaurantReviewController extends Controller
{


    public $layout = "blank";



    public function actionNew($restaurantId)
    {

        //return $this->render('new');


        $restaurantReview = new RestaurantReview();


        if ($restaurantReview->load(Yii::$app->request->post()) && $restaurantReview->save()) {

            //redirect to some sort of like thank you or success page for when the RR is logged
            //return $this->redirect(['view', 'id' => $model->id]);
            return "Thank you for your restaurant review!";

        } else {

            return $this->render('new', [
                'model' => $restaurantReview,
                'restaurantID' => $restaurantId,
            ]);

        }

    }





    public function actionShowAll()
    {
        return $this->render('show-all');
    }

}
