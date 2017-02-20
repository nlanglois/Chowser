<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\LocationType;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Restaurant */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="restaurant-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->textInput(['placeholder' => "Name of restaurant"])->hint('Please enter the restaurant\'s name') ?>

    <?= $form->field($model, 'street1')->textInput(['maxlength' => true])->textInput(['placeholder' => "First line of street address"]) ?>

    <?= $form->field($model, 'street2')->textInput(['maxlength' => true])->textInput(['placeholder' => "Second line of street address (optional)"]) ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'state')->dropdownList(
        \Yii::$app->params['us_states'],
        ['prompt'=>'Select US state']
    )->hint('Please choose the state that this restaurant is located in');
    ?>

    <?= $form->field($model, 'zip')->textInput()->textInput(['placeholder' => "Restaurant zip code"]) ?>

    <?php
        $allMealTypes = ArrayHelper::map($mealTypes, 'id', 'mealTypeName');
        echo $form->field($model, 'mealTypes_field')->checkboxList($allMealTypes, ['unselect' => NULL]);
    ?>

    <?= $form->field($model, 'locationTypeID')->widget(Select2::className(), [
        'data' => ArrayHelper::map(LocationType::find()->asArray()->all(), 'id', 'locationTypeName'),
            'language' => 'en',
            'options' => ['placeholder' => 'Choose which type of restaurant this is'],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ])->label('Restaurant type') ?>


    <?php
        if ($model->hasPhoto()) {
            echo Html::tag("p", Html::tag("b", "Currently uploaded image:"));
            echo Html::img(Yii::getAlias('@web') . '/' . $model->getUploadedFilePath(), ['width' => '400']);
            echo $form->field($model, 'upload_file')->fileInput()->label("Select new photo");
        } else {
            echo $form->field($model, 'upload_file')->fileInput();
        }
    ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
