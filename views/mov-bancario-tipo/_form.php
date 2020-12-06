<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\MovBancarioTipo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mov-bancario-tipo-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="col-lg-12">
        <label for="movbancariotipo-descripcion" class="lbl-view">Descripción</label>
        <?= $form->field($model, 'descripcion')->textarea(['rows' => 2])->label(false) ?>
    </div>

    <div class="col-lg-12">
        <label for="movbancariotipo-tipo_movimiento" class="lbl-view">Tipo de Movimiento (Entrada / Salida)</label>
        <?= $form->field($model, 'tipo_movimiento')->widget(Select2::classname(), [
            'data' => ['ENTRADA' => 'ENTRADA', 'SALIDA' => 'SALIDA'],
            'options' => ['placeholder' => 'Seleccione Tipo de Movimiento'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label(false) ?>        
        <?= $form->field($model, 'status')->hiddenInput(['value' => 1])->label(false) ?>
    </div>

    <div class="col-lg-12 mt-4">
        <div align="right" class="form-group">
            <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
