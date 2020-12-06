<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BancoOperador */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="banco-operador-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="col-lg-12">
        <label for="banco-operador-nombre_banco" class="lbl-view">Nombre del Banco</label>
        <?= $form->field($model, 'nombre_banco')->textInput(['maxlength' => true, 'placeholder' => 'Ej. Bancolombia'])->label(false) ?>
    </div>

    <div class="col-lg-12 mt-2">
        <label for="banco-operador-descripcion" class="lbl-view">Descripción de la Entidad Bancaria (Opcional)</label>
        <?= $form->field($model, 'descripcion')->textarea(['rows' => 2])->label(false) ?>
        <?= $form->field($model, 'status')->hiddenInput(['value' => 1])->label(false) ?>
    </div>

    <div class="col-lg-12 mt-4">
        <div align="right" class="form-group">
            <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
