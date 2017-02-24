<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RestaurantReview */
/* @var $form ActiveForm */
?>
<div class="restaurantReview-new">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            <?= $form->field($model, 'title') ?>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <?= $form->field($model, 'rating') ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <?= $form->field($model, 'review') ?>
        </div>
    </div>


        <?= $form->field($model, 'restaurantId')->hiddenInput(['value'=> $restaurantID])->label(false) ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- restaurantReview-new -->
