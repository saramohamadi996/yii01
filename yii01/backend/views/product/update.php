<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */
/* @var $form yii\widgets\ActiveField */
?>

<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
<?= $form->field($model, 'price')->textInput(['type'=>'number']) ?>

<div class="form-group">
    <?= Html::submitButton('submit', ['class'=>'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>
