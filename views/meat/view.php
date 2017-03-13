<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Meat */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Meats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="meat-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Meat', ['create'], ['class' => 'btn btn-success']) ?>
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
            'name',
        ],
    ]) ?>


    <!-- Gridview would go here -->
    <!-- Needs to receive variable FROM Controller containing the query that this GridView is to display -->
    <?= Html::tag('h4', "Meals containing this meat:") ?>
    <?= GridView::widget([
        'dataProvider' => $mealsModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            'Name',
            'Description:html',
            [
                'class' => 'yii\grid\ActionColumn',
                'controller' => 'meal',
            ]
        ],
    ]); ?>

</div>
