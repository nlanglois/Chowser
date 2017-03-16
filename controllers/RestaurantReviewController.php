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

            //send out an email to all of us project devs when a review is submitted
            if (Yii::$app->mailer->compose(
                ['html' => 'layouts/chowser'],
                [
                    'chowserLogo' => 'http://referral.umphysicians.com/images/UMHealth-logo-250w.gif',
                    'content' => 'A new review for ' . $restaurant->name . ' has been submitted! Log in to the admin app now to validate and approve it.',
                ])

                //->setFrom([Yii::$app->params['POFormAdminEmail'] => Yii::$app->name])
                ->setFrom([Yii::$app->params['adminEmail'] => Yii::$app->name . ' Web App'])
                ->setTo(Yii::$app->params['devEmails'])
                //->setBcc(Yii::$app->params['adminEmail'])
                ->setSubject(Yii::$app->name . ': Restaurant Review for ' . $restaurant->name)
                ->send()) {

                Yii::$app->session->setFlash('email-send-success');

            } else {
                Yii::$app->session->setFlash('email-send-failure');

            }



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
