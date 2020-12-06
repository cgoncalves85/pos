<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Modal;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Bancos */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="bancos-form">
    <?php $form = ActiveForm::begin(); ?>
        <div class="row">
            <div class="col-lg-8">
                <label for="bancos-banco_operador_id" class="lbl-view">Banco</label>
                <?= $form->field($model, 'banco_operador_id')->widget(Select2::classname(), [
                    'data' => $bancos,
                    'options' => ['placeholder' => 'Seleccione Banco'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])->label(false) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <label for="bancos-nro_cuenta" class="lbl-view">N° de Cuenta</label>
                <?= $form->field($model, 'nro_cuenta')->textInput(['maxlength' => true])->label(false) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <label for="bancos-descripcion_cuenta" class="lbl-view">Descripción</label>
                <?= $form->field($model, 'descripcion_cuenta')->textarea(['rows' => 2])->label(false) ?>
            </div>

            <div class="col-lg-12 mb-2">
                <div class="row">
                    <div class="col-lg-6">
                        <label for="bancos-saldo_inicial" class="lbl-view">Saldo Inicial</label>
                        <?= $form->field($model, 'saldo_inicial', [
                            'inputTemplate' => '<div class="input-group"><div class="input-group-prepend"><span class="input-group-text"><b>$</b></span></div>{input}</div>',
                        ])->textInput(['maxlength' => true])->label(false) ?>
                    </div>
                    <?= $form->field($model, 'status')->hiddenInput(['value' => 1])->label(false) ?>
                    <div class="col-lg-6">
                        <div align="right" class="form-group" style="margin-top: 30px">
                            <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
                        </div>
                    </div> 
                </div>                       
            </div>
        </div>
    <?php ActiveForm::end(); ?>
</div>