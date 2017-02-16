<?php
/* @var $this yii\web\View */

use yii\helpers\Html;


?>
<h1>Find by Restaurant</h1>

<h3>Where would you like to eat?</h3>

<div class="all-restaurants">
    <?php
        foreach ($dataProvider->getModels() as $restaurant)
        {
            print Html::a(
                    Html::img(
                        Yii::getAlias('@web') . '/' . $restaurant->getUploadedFilePath(),
                        [
                            'width' => '100',
                            'alt' => 'Primary image for ' . Html::encode($restaurant->name)
                        ]
                    ) . Html::tag('p', $restaurant->name)
                , ['find/restaurant', 'id' => $restaurant->id]);

        }

    ?>

</div>
