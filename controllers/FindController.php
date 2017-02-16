<?php

namespace app\controllers;

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




    public function actionBylocationtype()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => LocationType::find(),
        ]);
        return $this->render('bylocationtype');
    }





    public function actionBymeal()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Meal::find(),
        ]);
        return $this->render('bymeal');
    }






    public function actionByrestaurant()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Restaurant::find(),
        ]);

        return $this->render('byrestaurant', [
            'dataProvider' => $dataProvider,
        ]);
    }

}
