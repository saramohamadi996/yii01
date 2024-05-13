<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$form = ActiveForm::begin([
    'id' => 'user-form',
    'options' => ['class' => 'form-horizontal'],
]);
?>

<?= $form->field(null, 'name')->textInput() ?>
<?= $form->field(null, 'email')->textInput() ?>
<?= $form->field(null, 'password')->passwordInput() ?>

<div class="form-group">
    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
</div>

<?php //ActiveForm::end(); ?>

