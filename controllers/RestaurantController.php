<?php

namespace app\controllers;

use Yii;
use app\models\Meal;
use app\models\MealType;
use app\models\RestaurantSearch;
use app\models\Restaurant;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RestaurantController implements the CRUD actions for Restaurant model.
 */
class RestaurantController extends Controller
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Restaurant models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RestaurantSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //  $dataProvider->query->andFilterWhere(['status'=>1]);

        /*
        $dataProvider = new ActiveDataProvider([
            'query' => Restaurant::find(),
        ]);
        */

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single Restaurant model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $queryMealsInRestaurant = new ActiveDataProvider([
            'query' => Meal::find()->where(['restID' => $id]),
        ]);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'mealsInRestaurant' => $queryMealsInRestaurant,
        ]);
    }

    /**
     * Creates a new Restaurant model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Restaurant();
        $mealTypes = MealType::find()->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

//            //Loop through each selected meal type and write to the RestMealTypeLT
//            foreach ($_POST['Restaurant']['mealTypes'] as $typeId) {
//                $restMealType = new RestMealTypeLT(); // Instantiate new RestMealTypeLT model
//                $restMealType->restID = $model->id;
//                $restMealType->mealTypeID = $typeId;
//                $restMealType->save();
//            }


            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'mealTypes' => $mealTypes,
            ]);
        }
    }

    /**
     * Updates an existing Restaurant model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $mealTypes = MealType::find()->all();

        // Retrieve the stored checkboxes
        $model->mealTypes_field = ArrayHelper::getColumn(
            $model->getRestaurantMeals()->asArray()->all(),
            'mealTypeID'
        );


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'mealTypes' => $mealTypes,
            ]);
        }
    }

    /**
     * Deletes an existing Restaurant model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Restaurant model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Restaurant the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Restaurant::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
