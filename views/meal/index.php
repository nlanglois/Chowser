<?php

use yii\helpers\Html;
use yii\grid\GridView;

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
                'value' => 'restaurant.name',
            ],
            [
                'attribute' => 'MealType',
                //'value' => 'mealType.mealTypeName',
                'format' => 'raw',
                'value' => function($data) {
                    return Html::a
                        ($data->mealType->mealTypeName, ['meal-type/view', 'id' => $data->mealTypeID]);
                },

            ],


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
