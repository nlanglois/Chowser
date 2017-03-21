<?php

use yii\helpers\Html;
use kartik\tabs\TabsX;
use yii\jui\Tabs;
use yii\helpers\Url;
use app\models\RestaurantReview;

$this->title = $restaurant->name;

?>

<div class="restaurantDetail">

    <h1><?= $restaurant->name ?></h1>

    <div class="row">
        <div class="col-md-6">
            <img src="<?= (Yii::getAlias('@web') . '/' . $restaurant->getUploadedFilePath()); ?>"class="img-responsive" />
        </div>
        <div class="col-md-6">
            <div class="description">
                    <h2>Description: </h2>
                    <p><?= $restaurant->description ?></p>
                <iframe width="100%" height="200" frameborder="0" scrolling="no" marginwidth="0" marginheight="0" src="https://maps.google.it/maps?q=<?php echo $restaurant->street1. "," .$restaurant->street2. " " .$restaurant->city. "," .$restaurant->state. " " .$restaurant->zip ?>&output=embed"></iframe>
            </div>
        </div>
    </div>
    <div class="details">
        <div class="address">

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
                            ['mealdetail', 'id' => $restaurantMeal->id],
                            ['style' => 'background-image: url(' . Yii::getAlias('@web') . '/' . $restaurantMeal->getUploadedFilePath() .')']
                    );

            };
            ?>



            </div>



        <?php
        echo Tabs::widget([
            'items' => [
                [
                    'label' => 'Your Review',
                    'url' => ['restaurant-review/new?restaurantId=' . $restaurant->id],
                ],
                [
                    'label' => 'Read Reviews',
                    'url' => ['restaurant-review/show-all?restaurantId=' . $restaurant->id],
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




