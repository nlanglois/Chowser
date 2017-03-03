<?php

use yii\helpers\Html;
use kartik\tabs\TabsX;
use yii\helpers\Url;

$this->title = $meal->Name;

?>

<div class="mealDetail">

    <div class="image">
        <img src="<?= (Yii::getAlias('@web') . '/' . $meal->getUploadedFilePath()); ?>" style="img-fluid" />
    </div>

    <h1><?= $meal->Name ?></h1>

    <div class="details">

        <div class="description">
            <h3>Description: </h3><p>&nbsp; <?= $meal->Description ?></p>
        </div>

        <div class="price">
            <h3>Price: $<?= $meal->Price ?></h3>
        </div>

        <h3>Restaurant that serves <?= $meal->Name ?>: <?= Html::a($meal->restaurant->name, ['find/restaurantdetail', 'id' => $meal->restID]) ?></h3>

        <div class="restaurant">


<!---->
<!--            --><?php
//
//            $allRestaurants = $meal->getModels();
//
//            if (count($allMeals) == 0) {
//                echo "This meal is not served at any restaurant in our database.";
//            } else {
//                foreach ($allMeals as $restaurantMeal)
//                    print Html::a(
//                        Html::tag('div', Html::tag('span', $restaurantMeal->Name), ['class' => 'name']),
//                        ['meal', 'id' => $restaurantMeal->id],
//                        ['style' => 'background-image: url(' . Yii::getAlias('@web') . '/' . $restaurantMeal->getUploadedFilePath() .')']
//                    );
//
//            };
//            ?>
<!---->
<!---->
<!---->
        </div>



<!--        --><?php
//
//        $restaurantReview = new RestaurantReview();
//
//        echo TabsX::widget([
//            'items' => [
//                [
//                    'label' => 'Your Review',
//                    'content' => 'Sample content here',
//                    'active' => true,
//                    'encode' => true,
//                    'linkOptions' => [
//                        'data-url' => Url::to([
//                            'restaurant-review/new',
//                            'tab' => 1,
//                            'restaurantId' => $restaurant->id,
//                            'ajax' => 'true',
//                        ])
//                    ]
//                ],
//                [
//                    'label' => 'Read Reviews',
//                    'content' => 'Sed non urna. Phasellus eu ligula. Vestibulum sit amet purus...',
//                    'options' => ['tag' => 'div'],
//                    'linkOptions' => [
//                        'data-url' => Url::to([
//                            'restaurant-review/show-all',
//                            'restaurantId' => $restaurant->id,
//                            'ajax' => 'true',
//                        ])
//                    ],
//                    'headerOptions' => ['class' => 'my-class'],
//                ],
//            ],
//            'position' => TabsX::POS_ABOVE,
//            'align' => TabsX::ALIGN_LEFT,
//            'encodeLabels' => false,
//            'bordered' => true,
//
//            /*
//            'options' => ['tag' => 'div'],
//            'itemOptions' => ['tag' => 'div'],
//            'headerOptions' => ['class' => 'my-class'],
//            'clientOptions' => ['collapsible' => false],
//            */
//        ]);
//
//        ?>


    </div>

</div>
