<?php

use yii\helpers\Html;

echo Html::tag('h1', $restaurant->name);

echo Html::img(Yii::getAlias('@web') . '/' . $restaurant->getUploadedFilePath());
