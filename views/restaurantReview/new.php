<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;
use kartik\rating\StarRating;

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
            <?php echo $form->field($model, 'rating')->widget(StarRating::className(), [
                    'pluginOptions' => [
                            'min' => 0,
                            'max' => 5,
                            'step' => 0.5,
                            'size' => 'md',
                    ]
            ]); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <?= $form->field($model, 'review')->widget(TinyMce::className(), [
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

        </div>
    </div>


        <?= $form->field($model, 'restaurantId')->hiddenInput(['value'=> $restaurantID])->label(false) ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- restaurantReview-new -->
