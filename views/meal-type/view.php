<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\MealType */

$this->title = $model->mealTypeName;
$this->params['breadcrumbs'][] = ['label' => 'Meal Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="meal-type-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'mealTypeName',
        ],
    ]) ?>

    <?= Html::tag('h4', "Meals of this type:") ?>
    <?= GridView::widget([
        'dataProvider' => $mealsInThisType,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'Name',

            [
                    'class' => 'yii\grid\ActionColumn',
                    'controller' => 'meal',
            ],
        ],
    ]); ?>


</div>

