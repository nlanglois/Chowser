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
    <?=Html::img('@web/images/chowser1.png')?>
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


    <div class="footer">
            <p>&copy; Chowser <?= date('Y') ?></p>
            <p><?= Yii::powered() ?></p>
    </div>


</div>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>