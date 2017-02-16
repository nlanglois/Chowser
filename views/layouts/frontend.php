<?php
use yii\helpers\Html;
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
use app\assets\AppAssetFrontEnd;

AppAssetFrontEnd::register($this);

/* @var $this yii\web\View */
/* @var $content string */
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>


    <?//= Html::img( '@web/images/image1') ?>


    <div class="wrapper">
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



    <?= $content ?>




    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; Chowser <?= date('Y') ?></p>

            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>



    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>