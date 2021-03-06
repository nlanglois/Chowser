<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\LocationType */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $model->locationTypeName;
$this->params['breadcrumbs'][] = ['label' => 'Location Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="location-type-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Location Type', ['create'], ['class' => 'btn btn-success']) ?>
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
            'locationTypeName',
        ],
    ]) ?>

    <?= Html::tag('h4', "Restaurants of this type:") ?>
    <?= GridView::widget([
        'dataProvider' => $queryLocationTypeInRestaurant,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            'name',
            [
                'class' => 'yii\grid\ActionColumn',
                'controller' => 'restaurant',
            ],
        ],
    ]); ?>

</div>

