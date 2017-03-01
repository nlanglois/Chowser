<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAssetFrontEnd;

AppAssetFrontEnd::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/css?family=Caveat+Brush|Dosis" rel="stylesheet">
    <meta charset="UTF-8"/>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrapper">
    <div class="chowserhead">
        <?=Html::img('@web/images/chowser1.png')?>
    </div>
    <?php
    NavBar::begin([
        'options' => [
            'class' => 'ch-navbar navbar-static-top',
        ],


    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-center active'],
        'items' => [
            ['label' => 'Near You','url' => ['find/locationproximity'],
                'template' => '<a href="{url}" class="href_class">{label}</a>',

            ],
            ['label' => 'Find Location Type','url' => ['find/locationtype'],
                'template' => '<a href="{url}" class="href_class">{label}</a>',

            ],
            ['label' => 'Find Meal','url' => ['find/meal'],
                'template' => '<a href="{url}" class="href_class">{label}</a>',

            ],
            ['label' => 'Find Restaurant','url'  => ['find/restaurant'],
                'template' => '<a href="{url}" class="href_class">{label}</a>',
            ],



        ],
    ]);


    /*
     * Good examples for how to use Navbar widget in Yii2:
     * http://www.bsourcecode.com/yiiframework2/menu-widget-in-yii-framework-2-0/
     */

    /*
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Manage restaurants', 'url' => ['/restaurant/index'],
                'options'=>['class'=>'dropdown'],
                'template' => '<a href="{url}" class="href_class">{label}</a>',
                'items' => [
                    ['label' => 'All restaurants', 'url' => ['/restaurant/index']],
                    ['label' => 'All location types', 'url' => ['location-type/index']],
                ],

            ],

            ['label' => 'Manage meals', 'url' => ['/meal/index'],
                'options'=>['class'=>'dropdown'],
                'template' => '<a href="{url}" class="href_class">{label}</a>',
                'items' => [
                    ['label' => 'All meals', 'url' => ['/meal/index']],
                    ['label' => 'All meal types', 'url' => ['meal-type/index']],
                    ['label' => 'All meat types', 'url' => ['meat/index']],
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
    //    ],
    //]);



    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container" style="color: white">
        <p class="pull-left">&copy; Chowser <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
