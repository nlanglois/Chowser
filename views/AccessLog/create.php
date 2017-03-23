<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AccessLog */

$this->title = 'Create Access Log';
$this->params['breadcrumbs'][] = ['label' => 'Access Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="access-log-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
