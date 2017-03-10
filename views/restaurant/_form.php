<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\LocationType;
use dosamigos\tinymce\TinyMce;
use kartik\select2\Select2;
use yii\web\JsExpression;
use yii\widgets\MaskedInput;


/* @var $this yii\web\View */
/* @var $model app\models\Restaurant */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="restaurant-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <?= $form->field($model, 'name')
        ->textInput(['maxlength' => true])
        ->textInput(['placeholder' => "Name of restaurant"])
        ->hint('Please enter the restaurant\'s name')
    ?>


    <?= $form->field($model, 'description')
        ->widget(TinyMce::className(), [
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
            ]])
        ->hint('You can enter HTML text in here if you\'d like')
    ?>

    <div class="form-group">
        <label class="control-label">Hours of Operation</label>

        <div class="row seven-cols">
            <?php

            $count = 0;
            foreach (\Yii::$app->params['daysOfWeek'] as $day) {

                print '<div class="col-lg-1 col-md-1 col-sm-1">';

                    echo $form->field($restaurantHours, 'restId[' . $count . ']')
                        ->hiddenInput(['value'=> $restaurantHours['restId']])
                        ->label(false);

                    echo $form->field($restaurantHours, 'dayOfWeek[' . $count . ']')
                        ->hiddenInput(['value'=> $day])
                        ->label(false);

                    print $day;

                    print $form->field($restaurantHours, 'open[' . $count . ']')
                        ->dropDownList(
                            \Yii::$app->params['openHours'],
                            [
                                'style' => 'width:10em !important',
                                'prompt'=>'Select time']
                        );

                    print $form->field($restaurantHours, 'close[' . $count . ']')
                        ->dropDownList(
                            \Yii::$app->params['closedHours'],
                            [
                                'style' => 'width:10em !important',
                                'prompt'=>'Select time']
                        );

                print '</div>';

                $count++;

            }
            ?>


        </div>
    </div>


    <?= $form->field($model, 'street1')
        ->textInput(['maxlength' => true])
        ->textInput(['placeholder' => "First line of street address"])
    ?>

    <?= $form->field($model, 'street2')
        ->textInput(['maxlength' => true])
        ->textInput(['placeholder' => "Second line of street address (optional)"])
    ?>

    <?= $form->field($model, 'city')
        ->textInput(['maxlength' => true])
    ?>

    <?= $form->field($model, 'state')
        ->dropdownList(
            \Yii::$app->params['us_states'],
            ['prompt'=>'Select US state']
        )
        ->hint('Please choose the state that this restaurant is located in');
    ?>

    <?= $form->field($model, 'zip')
        ->widget(MaskedInput::className(), ['mask' => '99999'])
        ->input('zip', ['placeholder' => "Restaurant zip code"])
    ?>




    <!-- Attempting to implement a jQuery lat/lon chooser for Restaurants -->
    <?php
    echo $form->field($model, 'coordinates')
        ->widget('\pigolab\locationpicker\CoordinatesPicker' , [
            'key' => 'AIzaSyDS3U06rV-UvA_mpjRSfn59CuL77MqUf6Q',   // require , Put your google map api key
            'valueTemplate' => '{latitude},{longitude}' , // Optional , this is default result format
            'options' => [
                'style' => 'width: 100%; height: 400px',  // map canvas width and height
            ] ,
            'enableSearchBox' => true , // Optional , default is true
            'searchBoxOptions' => [ // searchBox html attributes
                'style' => 'width: 300px;', // Optional , default width and height defined in css coordinates-picker.css
            ],
            'searchBoxPosition' => new JsExpression('google.maps.ControlPosition.TOP_LEFT'), // optional , default is TOP_LEFT
            'mapOptions' => [
                // google map options
                // visit https://developers.google.com/maps/documentation/javascript/controls for other options
                'mapTypeControl' => true, // Enable Map Type Control
                'mapTypeControlOptions' => [
                    'style'    => new JsExpression('google.maps.MapTypeControlStyle.HORIZONTAL_BAR'),
                    'position' => new JsExpression('google.maps.ControlPosition.TOP_LEFT'),
                ],
                'streetViewControl' => true, // Enable Street View Control
            ],
            'clientOptions' => [
                // jquery-location-picker options
                'radius'    => 300,
                'addressFormat' => 'street_number',
            ]
        ]);
    ?>


    <?php
        $allMealTypes = ArrayHelper::map($mealTypes, 'id', 'mealTypeName');
        echo $form->field($model, 'mealTypes_field')
            ->checkboxList($allMealTypes, ['unselect' => NULL]);
    ?>

    <?= $form->field($model, 'locationTypeID')
        ->widget(Select2::className(), [
            'data' => ArrayHelper::map(LocationType::find()->asArray()->all(), 'id', 'locationTypeName'),
                'language' => 'en',
                'options' => ['placeholder' => 'Choose which type of restaurant this is'],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
            ])
        ->label('Restaurant type')
    ?>


    <?php
        if ($model->hasPhoto()) {
            echo Html::tag("p", Html::tag("b", "Currently uploaded image:"));
            echo Html::img(Yii::getAlias('@web') . '/' . $model->getUploadedFilePath(), ['width' => '400']);
            echo $form->field($model, 'upload_file')->fileInput()->label("Select new photo");
        } else {
            echo $form->field($model, 'upload_file')->fileInput();
        }
    ?>



    <?= $form->field($model, 'status')
        ->radioList(
            \Yii::$app->params['yesNoArray'],
            ['prompt'=>'Choose...'])
        ->hint('Should this restaurant display in the application?');
    ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
