<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Restaurant */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="restaurant-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'street1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'street2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

    <?//= $form->field($model, 'state')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'state')->dropdownList(
        \Yii::$app->params['us_states'],
        ['prompt'=>'Select US state']
    );
    ?>

    <?= $form->field($model, 'zip')->textInput() ?>

    <? if (isset($mealTypes)): ?>
    <?= $form->field($model, 'mealTypes')->checkboxlist(ArrayHelper::map($mealTypes, 'id', 'mealTypeName'));?>

    <?= $form->field($model, 'locationTypeID')->textInput() ?>
    <? endif; ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
