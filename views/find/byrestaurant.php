<?php
/* @var $this yii\web\View */

use yii\helpers\Html;


?>
<h1>Find by Restaurant</h1>

<h3>Where would you like to eat?</h3>

<div class="all-restaurants">
    <?php
        foreach ($dataProvider->getModels() as $model)
        {
            print Html::a(
                Html::img(
                    Yii::getAlias('@web') . '/' . $model->getUploadedFilePath(),
                    [
                        'width' => '100',
                        'alt' => 'Primary image for ' . Html::encode($model->name)
                    ]
                ) . Html::tag('p', $model->name)
            );

        }

    ?>

</div>