<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\LocationType;

/* @var $this yii\web\View */
/* @var $model app\models\Restaurant */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="restaurant-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->textInput(['placeholder' => "Name of restaurant"])->hint('Please enter the restaurant\'s name') ?>

    <?= $form->field($model, 'street1')->textInput(['maxlength' => true])->textInput(['placeholder' => "First line of street address"]) ?>

    <?= $form->field($model, 'street2')->textInput(['maxlength' => true])->textInput(['placeholder' => "Second line of street address (optional)"]) ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

    <?//= $form->field($model, 'state')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'state')->dropdownList(
        \Yii::$app->params['us_states'],
        ['prompt'=>'Select US state']
    )->hint('Please choose the state that this restaurant is located in');
    ?>

    <?= $form->field($model, 'zip')->textInput()->textInput(['placeholder' => "Restaurant zip code"]) ?>


    <? if (isset($mealTypes)): ?>
    <?= $form->field($model, 'mealTypes')->checkboxlist(ArrayHelper::map($mealTypes, 'id', 'mealTypeName'));?>
    <? endif; ?>


    <?= $form->field($model, 'locationTypeID')->dropDownList(
        ArrayHelper::map(LocationType::find()->asArray()->all(), 'id', 'locationTypeName'),
        ['prompt' => 'Choose what type of restaurant this is']
        )->label('Restaurant type'); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
