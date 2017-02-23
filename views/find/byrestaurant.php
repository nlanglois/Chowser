<?php
/* @var $this yii\web\View */

use yii\helpers\Html;


?>
<h1>Find by Restaurant</h1>
<h3>Where would you like to eat?</h3>
<div class="bgheader" style="text-align: center; margin-bottom: -20px">
    <?=Html::img('@web/images/bgheader.png')?>
</div>
<hr>

<div class="all-restaurants">
    <?php
        foreach ($dataProvider->getModels() as $restaurant)
        {
            print Html::a(
                    Html::tag('div', Html::tag('span', $restaurant->name), ['class' => 'name'])
                    , ['restaurantdetail', 'id' => $restaurant->id], ['style' => 'background-image: url(' . Yii::getAlias('@web') . '/' . $restaurant->getUploadedFilePath() .')']
            );

        }

    ?>

</div>
