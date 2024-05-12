<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'tenants';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tenant-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Create Tenant', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <table class="table">
        <thead>
        <tr>
            <th>Name</th>
            <th>UUID</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($tenants as $tenant): ?>
            <tr>
                <td><?= Html::encode($tenant->name) ?></td>
                <td><?= Html::encode($tenant->uuid) ?></td>
                <td>
                    <?= Html::a('View', ['view', 'id' => $tenant->uuid], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Update', ['update', 'id' => $tenant->uuid], ['class' => 'btn btn-warning']) ?>
                    <?= Html::a('Delete', ['delete', 'id' => $tenant->uuid], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this tenant?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
