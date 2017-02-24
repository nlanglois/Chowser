<?php

use yii\helpers\Html;
use yii\bootstrap\Tabs;
use app\models\RestaurantReview;

?>

<div class="restaurantDetail">

    <div class="image">
        <img src="<?= (Yii::getAlias('@web') . '/' . $restaurant->getUploadedFilePath()); ?>" />
    </div>

    <h1><?= $restaurant->name ?></h1>

    <div class="details">
        <div class="address">
            <iframe width="100%" height="480" frameborder="0" scrolling="no" marginwidth="0" marginheight="0" src="https://maps.google.it/maps?q=<?php echo $restaurant->street1. "," .$restaurant->street2. " " .$restaurant->city. "," .$restaurant->state. " " .$restaurant->zip ?>&output=embed"></iframe>
        </div>

        <div class="description">
            <h3>Description: </h3><p>&nbsp; <?= $restaurant->description ?></p>
        </div>

        <h3>Meals served at <?= $restaurant->name ?>:</h3>

        <div class="meals">

            <?php

            $allMeals = $meals->getModels();

            if (count($allMeals) == 0) {
                echo "This restaurant has no meals.";
            } else {
                foreach ($allMeals as $restaurantMeal)
                    print Html::a(
                            Html::tag('div', Html::tag('span', $restaurantMeal->Name), ['class' => 'name']),
                            ['meal', 'id' => $restaurantMeal->id],
                            ['style' => 'background-image: url(' . Yii::getAlias('@web') . '/' . $restaurantMeal->getUploadedFilePath() .')']
                    );

            };
            ?>



            </div>



        <?php


            $restaurantReview = new RestaurantReview();
            echo Tabs::widget([
                'items' => [
                    [
                        'label' => 'Tab one',
                        'content' => $this->render('//restaurantReview/new', [
                            'model' => $restaurantReview,
                            'restaurantID' => $restaurant->id,
                        ]),
                    ],
                    [
                        'label' => 'Tab two',
                        'content' => 'Sed non urna. Phasellus eu ligula. Vestibulum sit amet purus...',
                        'options' => ['tag' => 'div'],
                        'headerOptions' => ['class' => 'my-class'],
                    ],
                    [
                        'label' => 'Tab with custom id',
                        'content' => 'Morbi tincidunt, dui sit amet facilisis feugiat...',
                        'options' => ['id' => 'my-tab'],
                    ],
                ],
                'options' => ['tag' => 'div'],
                'itemOptions' => ['tag' => 'div'],
                'headerOptions' => ['class' => 'my-class'],
                'clientOptions' => ['collapsible' => false],
            ]);


            ?>


    </div>

</div>




