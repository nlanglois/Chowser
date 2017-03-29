<?php
/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Find by Location Type';

?>
<h1>Find by Location Type</h1>
<h3>Find a Location Type !</h3>

<div class="bgheader responsive" style="text-align: center; margin-bottom: 10px">
    <?=Html::img('@web/images/bgheader.png',['style' => 'img-fluid'])?>
</div>
<br>

<div class="all-locationtypes">
    <div class="row">
    <?php
    foreach ($dataProvider->getModels() as $locationType)
    {
     print Html::a(
        Html::tag('h3', $locationType->locationTypeName, ['class' => 'col-sm-4'])
             , ['locationtypedetail', 'id' => $locationType->id]
     );
    }

    ?>
    </div>
</div>
