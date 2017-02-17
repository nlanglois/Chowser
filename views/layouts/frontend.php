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
    <?=Html::img('@web/images/chowser1.jpg')?>
    </div>
        <?php
        NavBar::begin([
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'ch-navbar navbar-static-top',
            ],
        ]);


        /*
         * Good examples for how to use Navbar widget in Yii2:
         * http://www.bsourcecode.com/yiiframework2/menu-widget-in-yii-framework-2-0/
         */
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-center'],
            'items' => [
                ['label' => 'Near You','url' => ['/find/bylocationproximity'],
                    'template' => '<a href="{url}" class="href_class">{label}</a>',

                ],
                ['label' => 'Find Location Type','url' => ['/find/bylocationtype'],
                    'template' => '<a href="{url}" class="href_class">{label}</a>',

                ],
                ['label' => 'Find Meal','url' => ['/find/bymeal'],
                    'template' => '<a href="{url}" class="href_class">{label}</a>',

                ],
                ['label' => 'Find Restaurant','url' => ['/find/byrestaurant'],
                    'template' => '<a href="{url}" class="href_class">{label}</a>',

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


        <div class="content">
            <?= $content ?>
        </div>


    <footer class="footer">
            <p class="pull-left">&copy; Chowser <?= date('Y') ?></p>

            <p class="pull-right"><?= Yii::powered() ?></p>
    </footer>


</div>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>