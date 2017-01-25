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
            'Price',
            'restaurant.name',  /* required creation of relational getter method in Meal class */
            [
                'attribute' => 'restID',
                'value' => 'restaurant.name', /* required creation of relational getter method in Meal class */
            ],
            // 'mealTypeID',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
