<?php

namespace app\controllers;

class FindController extends \yii\web\Controller
{
    public function actionBylocationproximity()
    {
        return $this->render('bylocationproximity');
    }

    public function actionBylocationtype()
    {
        return $this->render('bylocationtype');
    }

    public function actionBymeal()
    {
        return $this->render('bymeal');
    }

    public function actionByrestaurant()
    {
        return $this->render('byrestaurant');
    }

}
