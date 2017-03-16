<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
?>

<?= Html::tag('h3', 'Thank you for your review of ' . $restaurant->name . '!') ?>
<?= Html::tag('p', 'We have logged it to our database.') ?>



<!--
    See here for how to do alerts in Bootstrap:
    https://www.w3schools.com/bootstrap/bootstrap_alerts.asp
-->
<?php if(Yii::$app->session->hasFlash('email-send-failure')): ?>
    <div class="alert alert-error" role="alert">
        Sorry, we couldn't send out the confirmation email. Check the logs to see why.
    </div>

<?php elseif(Yii::$app->session->hasFlash('email-send-success')): ?>
    <div class="alert alert-success alert-dismissable" role="alert">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        We have alerted the site admins about your new review!
    </div>

<?php endif; ?>

