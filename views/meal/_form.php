<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Restaurant;
use app\models\MealType;
use app\models\Meat;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Meal */
/* @var $form yii\widgets\ActiveForm */


/*
 * Good examples of how to customize ActiveForm elements:
 * http://tutsnare.com/how-to-create-forms-in-yii-2/
 * http://www.yiiframework.com/doc-2.0/guide-input-forms.html
 */
?>

<div class="meal-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'restID')->dropDownList(
        ArrayHelper::map(Restaurant::find()->asArray()->all(), 'id', 'name'),
            ['prompt' => 'Choose where this meal can be found']

    )->label('Restaurant'); ?>

    <?= $form->field($model, 'mealTypeID')->dropDownList(
        ArrayHelper::map(MealType::find()->asArray()->all(), 'id', 'mealTypeName'),
            ['prompt' => 'Choose which type of meal this is']
    )->label('Meal type'); ?>

    <?= $form->field($model, 'meatID')->dropDownList(
            ArrayHelper::map(Meat::find()->asArray()->all(), 'id', 'name'),
                ['prompt' => 'Choose type of meat this meal is centered around or else choose none']
    )->label('Meat type'); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
