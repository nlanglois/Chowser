<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;
use app\models\Restaurant;
use app\components\MyHelpers;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $model app\models\Restaurant */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Restaurants', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="restaurant-view">

    <h1>Details for "<?= Html::encode($this->title) ?>"</h1>

    <p>
        <?= Html::a('Create Restaurant', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <p><?php
            $restaurant = \app\models\Restaurant::findOne($model->id);
            $mealTypes = $restaurant->mealTypes;

            /*
            print "<pre>";
                print_r($mealTypes);
            print "</pre>";
            */

        ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'template' => function($attribute) {
            // Hides any row whose attribute's value is empty
            if (!empty($attribute['value'])) {
                return "<tr>
                            <th>{$attribute['label']}</th>
                            <td>{$attribute['value']}</td>
                        </tr>";
            }
        },
        'attributes' => [
            //'id',
            'name',
            'street1',
            'street2',
            'city',
            'state',
            'zip',
            [
                'label' => 'Types of meals served here',
                'value' => MyHelpers::convertM2MobjectsToString(Restaurant::findOne($model->id)->mealTypes, "mealTypeName"),
            ],
            'locationType.locationTypeName',
            [
                'attribute' => 'photo',
                'value' => Html::img(Yii::getAlias('@web') . '/' . $model->getUploadedFilePath(), ['width' => '300', 'alt' => 'Primary image for ' . Html::encode($model->name)]),
        ],
            'description',
        ],
    ]) ?>

    <h3>Meals found at <?= Html::encode($this->title) ?></h3>
    <?= GridView::widget([
        'dataProvider' => $mealsInRestaurant,
        'showOnEmpty' => false,
        'emptyText' => 'No meals in the system for ' . $this->title . ' yet. ' . Html::a('Add one now!', ['meal/create']),
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
