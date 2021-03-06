<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MealType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="meal-type-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'mealTypeName')->textInput(['maxlength' => true])->textInput(['placeholder' => "Name of meal type"]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
