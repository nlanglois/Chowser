<?php

use yii\helpers\Html;

?>

<div class="restaurantDetail">

    <div class="image">
        <img src="<?= (Yii::getAlias('@web') . '/' . $restaurant->getUploadedFilePath()); ?>" />
    </div>

    <h1><?= $restaurant->name ?></h1>

    <div class="details">
        <div class="address">
            <h3>Location:</h3>
            <iframe width="100%" height="480" frameborder="0" scrolling="no" marginwidth="0" marginheight="0" src="https://maps.google.it/maps?q=<?php echo $restaurant->street1. "," .$restaurant->street2. " " .$restaurant->city. "," .$restaurant->state. " " .$restaurant->zip ?>&output=embed"></iframe>
        </div>

        <div class="description">
            <h3>Description: </h3><p>&nbsp; <?= $restaurant->description ?></p>
        </div>

        <div class="meals">
            <h3>Meals served at <?= $restaurant->name ?>:</h3>

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

            }

            ?>
        </div>

    </div>

</div>




