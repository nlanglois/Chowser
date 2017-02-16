<?php

namespace app\controllers;

use app\models\LocationType;
use yii\data\ActiveDataProvider;
use app\models\Restaurant;
use app\models\Meal;

class FindController extends \yii\web\Controller

{
    public $layout ='frontend';


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
