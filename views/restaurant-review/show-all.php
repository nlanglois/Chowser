<?php
/* @var $this yii\web\View */

use yii\helpers\Html;

?>
<h3>Reviews for <?= $restaurant->name; ?></h3>


<?php
    if (count($reviews) > 0) {
        foreach($reviews as $review)
        {
            echo $review->review;
        }

    } else {
        echo Html::tag('p', 'Sorry, no reviews have been posted for this restaurant.');
    }

?>