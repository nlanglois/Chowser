<?php
/**
 * Created by PhpStorm.
 * User: nlangloi10
 * Date: 1/20/17
 * Time: 3:05 AM
 */

\Yii::$container->set('yii\grid\ActionColumn', [
    'contentOptions' => [
        'style' => [
            'white-space' => 'nowrap',
            'width' => '70px',
        ]
    ],
]);

\Yii::$container->set('yii\grid\SerialColumn', [
    'contentOptions' => [
        'style' => [
            'width' => '20px',
        ]
    ],
]);