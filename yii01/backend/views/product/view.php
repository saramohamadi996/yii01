<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */

$this->title = $model->name;
?>

<div class="product-view">
    <h1>
        <?= Html::encode($this->title) ?>
    </h1>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'description',
            'price',
        ],
    ]) ?>
</div>
