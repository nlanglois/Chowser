<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RestaurantReview */
/* @var $form ActiveForm */
?>
<div class="restaurantReview-new">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'dateCreated') ?>
        <?= $form->field($model, 'lastModified') ?>
        <?= $form->field($model, 'title') ?>
        <?= $form->field($model, 'review') ?>
        <?= $form->field($model, 'rating') ?>
        <?= $form->field($model, 'restaurantId') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- restaurantReview-new -->
