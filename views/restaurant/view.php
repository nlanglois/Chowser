<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Restaurant */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Restaurants', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="restaurant-view">

    <h1>Details for the restaurant called "<?= Html::encode($this->title) ?>"</h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'template' => function($attribute) {
            // Hides any row whose attribute's value is empty
            if (!empty($attribute['value'])) {
                return "<tr>
                            <th>{$attribute['label']}</th>
                            <td>{$attribute['value']}</td>
                        </tr>";
            }
        },
        'attributes' => [
            //'id',
            'name',
            'street1',
            'street2',
            'city',
            'state',
            'zip',
        ],
    ]) ?>

</div>
