<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\LocationType;
use yii\data\ActiveDataProvider;
use app\models\Restaurant;
use app\models\Meal;

class FindController extends Controller

{


    public $layout = "frontend";


    public function actionLocationproximity()
    {
        return $this->render('bylocationproximity');
    }



// Search by Type of Restaurant //
    public function actionLocationtype()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => LocationType::find(),
        ]);
        return $this->render('bylocationtype');
    }




// Search by Meal//
    public function actionMeal()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Meal::find(),
        ]);
        return $this->render('bymeal');
    }





// Search by Restaurant //
    public function actionRestaurant()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Restaurant::find(),
        ]);

        return $this->render('byrestaurant', [
            'dataProvider' => $dataProvider,
        ]);
    }




    public function actionRestaurantdetail($id)
    {
        return $this->render('restaurantDetail', [
            //'restaurant' => Yii::$app->runAction('RestaurantController/findModel', $id),
            'restaurant' => $this->findRestaurant($id),
        ]);
    }



    /**
     * Finds the Restaurant model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Restaurant the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findRestaurant($id)
    {
        if (($model = Restaurant::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
