<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\LocationType;
use yii\data\ActiveDataProvider;
use app\models\Restaurant;
use app\models\Meal;
use yii\web\NotFoundHttpException;

class FindController extends Controller

{


    public $layout = "frontend";


    public function actionProximity()
    {
        return $this->render('byLocationProximity');
    }



// Search by Type of Restaurant //
    public function actionLocationtype()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => LocationType::find(),
        ]);
        return $this->render('byLocationType');
    }




// Search by Meal//
    public function actionMeal()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Meal::find(),
            'sort' => [
                'defaultOrder' => [
                    'Name' => SORT_ASC,
                ],
            ],
        ]);

        return $this->render('byMeal', [
            'dataProvider' => $dataProvider,
        ]);

    }


    public function actionMealdetail($id)
    {
        $mealAtRestaurant = new ActiveDataProvider([
           'query' => Meal::find()
                        ->where(['restID' => $id])
        ]);

        return $this->render('mealDetail', [
            'meal' => $this->findMeal($id),
            'restaurant' => $mealAtRestaurant,
        ]);
    }


// Search by Restaurant //
    public function actionRestaurant()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Restaurant::find(),
            'sort' => [
                'defaultOrder' => [
                    'name' => SORT_ASC,
                ],
            ],
        ]);

        return $this->render('byRestaurant', [
            'dataProvider' => $dataProvider,
        ]);

    }




    public function actionRestaurantdetail($id)
    {

        $restaurantMeals = new ActiveDataProvider([
            'query' => Meal::find()
                        ->where(['restID' => $id])
        ]);

        return $this->render('restaurantDetail', [
            //'restaurant' => Yii::$app->runAction('RestaurantController/findModel', $id),
            'restaurant' => $this->findRestaurant($id),
            'meals' => $restaurantMeals,
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

    protected function findMeal($id)
    {
        if (($model = Meal::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
