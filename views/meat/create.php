<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Meat */

$this->title = 'Create Meat';
$this->params['breadcrumbs'][] = ['label' => 'Meats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="meat-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
