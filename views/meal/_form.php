<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Restaurant;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Meal */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="meal-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'restID')->dropDownList(
            ArrayHelper::map(Restaurant::find()->asArray()->all(), 'id', 'name'),
        ['prompt'=>'Select...']

    ); ?>

    <?= $form->field($model, 'mealTypeID')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
