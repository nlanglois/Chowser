<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Restaurant;
use app\models\LocationType;


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

            [
                'attribute' => 'street1',
                'format' => 'raw',
                'value' => function($model) {
                    return $model->street1 . " (" .
                        Html::a
                            ("map", "https://www.google.com/maps/place/" . $model->street1 . "," . $model->city . "," . $model->state . "," . $model->zip,
                                [
                                    'title'=>'Check out ' . $model->name . '\'s location on Google Maps',
                                    'target'=>'_blank',
                                ]
                            )
                        . ")";
                },
            ],

            [
                'attribute' => 'street2',
                'value' => function($data) {
                    return !empty($data->street2) ? $data->street2 : '<span class="glyphicon glyphicon-question-sign"></span>';
                },
                'format' => 'raw',
            ],
            'city',
            [
                'attribute' => 'state',
                'filter' => Html::activeDropDownList($searchModel, 'state', ArrayHelper::map(Restaurant::find()->asArray()->distinct()->all(), 'state', 'state'), ['class'=>'form-control','prompt' => 'All']),
                'contentOptions' => ['style' => 'width: 70px;'],
            ],
            [
                'attribute' => 'locationName',
                'format' => 'raw',
                'value' => function($data) {
                    return Html::a
                        ($data->locationType->locationTypeName, ['location-type/view', 'id' => $data->locationTypeID]);
                },
                'filter' => Html::activeDropDownList($searchModel, 'locationTypeID', ArrayHelper::map(LocationType::find()->asArray()->distinct()->orderBy('locationTypeName')->all(), 'id', 'locationTypeName'), ['class'=>'form-control','prompt' => 'All']),
                'contentOptions' => ['style' => 'width: 70px;'],
            ],
            'zip',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
