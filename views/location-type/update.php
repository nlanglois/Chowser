<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LocationType */

$this->title = 'Update Location Type: ' . $model->locationTypeName;
$this->params['breadcrumbs'][] = ['label' => 'Location Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->locationTypeName, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="location-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
