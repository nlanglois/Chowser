<?php

namespace app\controllers;

use Yii;
use yii\base\Controller;
use app\models\LocationType;
use yii\data\ActiveDataProvider;
use app\models\Restaurant;
use app\models\Meal;

class FindController extends Controller

{

    public function beforeAction($action)
    {
        $this->layout = 'frontend'; //your layout name
        return parent::beforeAction($action);
    }


    public function actionBylocationproximity()
    {
        return $this->render('bylocationproximity');
    }



// Search by Type of Restaurant //
    public function actionBylocationtype()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => LocationType::find(),
        ]);
        return $this->render('bylocationtype');
    }




// Search by Meal//
    public function actionBymeal()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Meal::find(),
        ]);
        return $this->render('bymeal');
    }





// Search by Restaurant //
    public function actionByrestaurant()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Restaurant::find(),
        ]);

        return $this->render('byrestaurant', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionRestaurant($id)
    {
        return $this->render('restaurantDetail', [
            'restaurant' => Yii::$app->runAction('RestaurantController/findModel', $id),
        ]);
    }

}
