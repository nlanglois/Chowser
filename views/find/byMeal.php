<?php
/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Find by Meal';

?>
<h1>Find by Meal</h1>
<h3>What would you like to eat?</h3>

<div class="bgheader responsive" style="text-align: center; margin-bottom: 10px">
    <?=Html::img('@web/images/bgheader.png',['style' => 'img-fluid'])?>
</div>
<br>

<div class="all-meals">
    <?php
        foreach ($dataProvider->getModels() as $meal)
        {
            print Html::a(
                    Html::tag('div', Html::tag('span', $meal->Name), ['class' => 'name'])
                    , ['mealdetail', 'id' => $meal->id], ['style' => 'background-image: url(' . Yii::getAlias('@web') . '/' . $meal->getUploadedFilePath() .')']
            );

        }

    ?>

</div>
