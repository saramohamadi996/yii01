<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\view */
/* @var $model backend\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="product-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'description')->textInput(['rows' => 6]) ?>
    <?= $form->field($model, 'price')->textInput(['type' => 'number']) ?>

    <div class="form-group">
        <?= Html::submitButton('submit', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
