<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use app\models\Restaurant;

?>
<h1>Find by Restaurant</h1>

<h3>Where would you like to eat?</h3>

<p>
    You may change the content of this page by modifying
    the file <code><?= __FILE__; ?></code>.
</p>

<div class="all-restaurants">
<?php
    foreach ($dataProvider->getModels() as $model)
    {
        print Html::a(
                Html::img(
                    Yii::getAlias('@web') . '/' . $model->getUploadedFilePath(),
                    [
                        'width' => '150',
                        'alt' => 'Primary image for ' . Html::encode($model->name)
                    ]
                ) . Html::tag('h4', $model->name),
                ['find/restaurant', 'id' => $model->id]
        );

    }

?>

</div>
