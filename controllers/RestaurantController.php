<?php

namespace app\controllers;

use app\models\RestaurantHours;
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
use yii\web\UploadedFile;
use yii\helpers\VarDumper;


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
        $mealTypes = MealType::find()->orderBy('mealTypeName')->all();

        $restaurantHours = new RestaurantHours();


        //echo VarDumper::dumpAsString($_POST['RestaurantHours'], 10, true);
        //die("Paused");






        $upload_file = $model->uploadFile();
        if ($upload_file !== false) {
            $upload_file->saveAs($model->getUploadedFilePath());
            $model->photo = $model->getUploadedFileName();
        }


        if ($model->load(Yii::$app->request->post()) &&
            $restaurantHours->load(Yii::$app->request->post()) &&
            $model->save()) {

//
//            $count = 0;
//            foreach($_POST['RestaurantHours'] as $key => $data)
//            {
//                $restaurantHours = new RestaurantHours();
//                $restaurantHours->restId = $model->id;
//                $restaurantHours->dayOfWeek = $_POST['RestaurantHours']['dayOfWeek'][$count];
//                $restaurantHours->save();
//
//                //print $data['dayOfWeek'];
//                //echo VarDumper::dumpAsString($_POST['RestaurantHours'], 10, true);
//
//                $count++;
//            }
//
//            die("paused...");




            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'mealTypes' => $mealTypes,
                'restaurantHours' => $restaurantHours,
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
        $mealTypes = MealType::find()->orderBy('mealTypeName')->all();
        $currentRestaurant = $this->findModel($id);

        $restaurantHours = new RestaurantHours();


        // Retrieve the stored checkboxes
        $model->mealTypes_field = ArrayHelper::getColumn(
            $model->getRestaurantMeals()->asArray()->all(),
            'mealTypeID'
        );


        /*
         * Handle uploading the selected file for this restaurant, if one was selected, and writing its filename to the Restaurant table. If $this already contained a photo, remove that file from filesystem first.
         */
        $upload_file = $model->uploadFile();
        if ($upload_file !== false) {

            if (!empty($currentRestaurant->photo)) {
                unlink(Yii::$app->params['restaurantFileUploadUrl'] . $currentRestaurant->photo);
            }

            $upload_file->saveAs($model->getUploadedFilePath());
            $model->photo = $model->getUploadedFileName();
        }


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);

        } else {
            $existingRestaurantHours = RestaurantHours::find()
                ->where(['restId' => $id])
                ->all();

            return $this->render('update', [
                'model' => $model,
                'mealTypes' => $mealTypes,
                'restaurantHours' => $restaurantHours,
                'existingRestaurantHours' => $existingRestaurantHours,
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

        // If the restaurant has a photo, find it, delete it
        if ($this->findModel($id)->hasPhoto()) {
            $photo = $this->findModel($id)->getUploadedFilePath();
            unlink($photo);
        }

        // If the restaurant has associations with MealTypes via the junction table, remove them
        \Yii::$app->db
            ->createCommand()
            ->delete('RestMealTypeLT', 'restID = ' . (int) $id)
            ->execute();

        // If the restaurant has associations with RestaurantHours, remove them
        \Yii::$app->db
            ->createCommand()
            ->delete('RestaurantHours', 'restId = ' . (int) $id)
            ->execute();

        // Finally, delete the restaurant record from Restaurant table
        $this->findModel($id)
            ->delete();

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
