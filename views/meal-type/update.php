<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MealType */

$this->title = 'Update Meal Type: ' . $model->mealTypeName;
$this->params['breadcrumbs'][] = ['label' => 'Meal Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->mealTypeName, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="meal-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
