<?php

namespace app\controllers;

class RestaurantReviewController extends \yii\web\Controller
{
    public function actionNew()
    {
        return $this->render('new');
    }

    public function actionShowAll()
    {
        return $this->render('show-all');
    }

}
