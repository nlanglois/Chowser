<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MealType */

$this->title = 'Create Meal Type';
$this->params['breadcrumbs'][] = ['label' => 'Meal Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="meal-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
