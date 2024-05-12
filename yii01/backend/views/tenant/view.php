<?php
use yii\helpers\Html;

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tenants', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tenant-view">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->uuid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->uuid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this tenant?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div>
        <strong>Name:</strong> <?= Html::encode($model->name) ?><br>
        <strong>UUID:</strong> <?= Html::encode($model->uuid) ?>
    </div>
</div>
