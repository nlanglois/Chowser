<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\MealType;
use app\models\Meat;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MealSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Meals';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="meal-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Meal', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'Name',
            'Description',
            [
                'attribute' => 'Price',
                'format' => [
                    'currency',
                    'USD',
                    [
                        \NumberFormatter::MIN_FRACTION_DIGITS => 2,
                        \NumberFormatter::MAX_FRACTION_DIGITS => 3,
                    ]
                ],
            ],
            //'restaurant.name',  /* required creation of relational getter method in Meal class */

            [
                'attribute' => 'RestaurantName',
                'label' => 'Restaurant',
                'format'=> 'raw',
                'value' => function($data) {
                    return Html::a
                    ($data->restaurant->name, ['restaurant/view', 'id' => $data->id]);
                },

            ],
            [
                'attribute' => 'MealType',
                'label' => 'Type',
                'format' => 'raw',
                'value' => function($data) {
                    return Html::a
                        ($data->mealType->mealTypeName, ['meal-type/view', 'id' => $data->mealTypeID]);
                },
                'filter' => Html::activeDropDownList($searchModel, 'mealTypeID', ArrayHelper::map(MealType::find()->asArray()->distinct()->all(), 'id', 'mealTypeName'), ['class'=>'form-control','prompt' => 'All']),

            ],

            //'meat.name',
            [
                'attribute' => 'Meat',
                'format' => 'raw',
                'value' => function($data) {
                    return Html::a
                        ($data->meat->name, ['meat/view', 'id' => $data->meatID]);
                },
                'filter' => Html::activeDropDownList($searchModel, 'meatID', ArrayHelper::map(Meat::find()->asArray()->distinct()->all(), 'id', 'name'), ['class'=>'form-control', 'prompt' => 'All']),
            ],


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
