<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>



<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Chowser',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'ch-navbar navbar-fixed-top',
        ],
    ]);


    /*
     * Good examples for how to use Navbar widget in Yii2:
     * http://www.bsourcecode.com/yiiframework2/menu-widget-in-yii-framework-2-0/
     */
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Search',
                'template' => '<a href="{url}" class="href_class">{label}</a>',
                'items' => [
                    ['label' => 'By Location Proximity', 'url' => ['/find/bylocationproximity']],
                    ['label' => 'By Meal', 'url' => ['find/bymeal']],
                    ['label' => 'By Restaurant', 'url' => ['find/byrestaurant']],
                    ['label' => 'By Location Type', 'url' => ['find/bylocationtype']],
        ],

            ],



            /*)
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
            */
        ],
    ]);
    NavBar::end();
    ?>

</div>


        <div class="content">

        </div>

    <div class="botNav">
        <a href="#">disclaimer</a>
        <a href="#">text only</a>
        <a href="#">webmaster</a>
    </div> <!-- END BOTNAV -->

    </div> <!-- END BODYCONTENT -->


    <div class="footer">
    </div>
</body>
</html>