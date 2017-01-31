<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Meal */

$this->title = $model->Name;
$this->params['breadcrumbs'][] = ['label' => 'Meals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="meal-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Meal', ['create'], ['class' => 'btn btn-success']) ?>
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
            'Name',
            'Description',
            //'Price',
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
            //'restaurant.name',
            [
                'attribute' => 'MealType',
                'format' => 'raw',
                'value' => Html::a($model->restaurant->name, ['restaurant/view', 'id' => $model->restID]),
            ],
            //'mealType.mealTypeName',
            [
                'attribute' => 'MealType',
                'format' => 'raw',
                'value' => HTML::a($model->mealType->mealTypeName, ['meal-type/view', 'id' => $model->mealTypeID]),
            ],
            'meat.name',
        ],
    ]) ?>

</div>
