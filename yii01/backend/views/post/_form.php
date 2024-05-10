<?php

use backend\models\Post;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

/** @var Post $model */
?>
<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'title') ?>
<?= $form->field($model, 'content') ?>
<?= $form->field($model, 'data_add') ?>

<?= Html::submitButton('submit') ?>

<?php ActiveForm::end(); ?>
