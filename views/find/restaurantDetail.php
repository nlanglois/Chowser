<?php

use app\controllers\MealController;

?>

<div class="restaurantDetail">

    <div class="image">
        <img src="<?= (Yii::getAlias('@web') . '/' . $restaurant->getUploadedFilePath()); ?>" />
    </div>

    <h1><?= $restaurant->name ?></h1>

    <div class="details">
        <div class="address">
            <h3>Location: </h3><p>&nbsp;<?= $restaurant->street1. " " .$restaurant->street2. " " .$restaurant->city. " " .$restaurant->state. " " .$restaurant->zip ?></p>
        </div>

        <div class="description">
            <h3>Description: </h3><p>&nbsp; <?= $restaurant->description ?></p>
        </div>

        <div class="meals">
            <h3>Meals served at <?= $restaurant->name ?>:</h3>
            <img src="<?= (Yii::getAlias('@web') . '/' . $meal->getUploadedFilePath()); ?>" />
        </div>

    </div>

    <!--    --><?php
//    echo Html::tag('h1', $restaurant->name);
//
//    echo Html::img(Yii::getAlias('@web') . '/' . $restaurant->getUploadedFilePath());
//    ?>
</div>




