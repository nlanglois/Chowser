<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Restaurant;
use app\models\MealType;
use app\models\Meat;
use yii\helpers\ArrayHelper;
use dosamigos\tinymce\TinyMce;

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
    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <?= $form->field($model, 'Name')->textInput(['maxlength' => true])->textInput(['placeholder' => "Please enter the name of the meal"]) ?>

    <?= $form->field($model, 'Description')->widget(TinyMce::className(), [
        'options' => ['rows' => 6],
        'language' => 'en_CA',
        'clientOptions' => [
            'menubar' => 'false',
            'plugins' => [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table contextmenu paste code'
            ],
            'toolbar' => 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        ]
    ])->hint('You can enter HTML text in here if you\'d like') ?>

    <?= $form->field($model, 'Price')->textInput(['maxlength' => true])->textInput(['placeholder' => "Please enter the price of this meal"])  ?>

    <?= $form->field($model, 'restID')->dropDownList(
        ArrayHelper::map(Restaurant::find()->asArray()->all(), 'id', 'name'),
            ['prompt' => 'Choose which restaurant this meal comes from']
        )->label('Restaurant'); ?>

    <?= $form->field($model, 'mealTypeID')->dropDownList(
        ArrayHelper::map(MealType::find()->asArray()->all(), 'id', 'mealTypeName'),
            ['prompt' => 'Choose which type of meal this is']
        )->label('Meal type'); ?>

    <?= $form->field($model, 'meatID')->dropDownList(
            ArrayHelper::map(Meat::find()->asArray()->all(), 'id', 'name'),
                ['prompt' => 'Choose type of meat this meal is centered around or else choose none']
        )->label('Meat type'); ?>

    <?php
    if ($model->hasPhoto()) {
        echo Html::tag("p", Html::tag("b", "Currently uploaded image:"));
        echo Html::img(Yii::getAlias('@web') . '/' . $model->getUploadedFilePath(), ['width' => '400']);
        echo $form->field($model, 'upload_file')->fileInput()->label("Select new photo");
    } else {
        echo $form->field($model, 'upload_file')->fileInput();
    }
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
