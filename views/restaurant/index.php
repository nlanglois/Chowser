<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel */

$this->title = 'Restaurants';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="restaurant-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Restaurant', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
            'street1',
            [
                'attribute' => 'street2',
                'value' => function($data) {
                    return !empty($data->street2) ? $data->street2 : '<span class="glyphicon glyphicon-question-sign"></span>';
                },
                'format' => 'raw',
            ],
            'city',
            'state',
            'zip',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
