<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Modal;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Bancos */
/* @var $form yii\widgets\ActiveForm */

Modal::begin([
  'title' => 'NUEVO OPERADOR BANCARIO',
  'id' => 'nuevo_operador',
  'size' => 'modal-md',
  'bodyOptions' => ['style' => 'top: 0px; padding:20px'],

]);

echo "<div id='modalContent'></div>";

Modal::end();

?>

<div class="bancos-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="col-lg-12 mt-2">
        <div class="row">
            <div class="col-lg-4">
                <?= $form->field($model, 'banco_operador_id')->widget(Select2::classname(), [
                    'data' => $bancos,
                    'options' => ['placeholder' => 'Seleccione Banco'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]) ?>
            </div>
            <div class="col-lg-2" style="margin-top: 35px">
                <?= Html::button('<i class="fas fa-plus"></i>', [                        
                    'value' => Yii::$app->urlManager->createUrl('/banco-operador/create'),
                    'class' => 'btn btn-success btn-sm',
                    'id' => 'BtnOperador',
                    'data-toggle'=> 'modal',
                    'data-target'=> '#nuevo_operador',
                ]) ?> 
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'nro_cuenta')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'saldo_inicial', [
                    'inputTemplate' => '<div class="input-group"><div class="input-group-prepend"><span class="input-group-text"><b>$</b></span></div>{input}</div>',
                ])->textInput(['maxlength' => true, 'readonly' => 'true', 'autocomplete' => 'off']) ?>
            </div>           
        </div>
    </div>

    <div class="col-lg-12 mt-2">
        <div class="row">
            <div class="col-lg-9">
                <label for="bancos-descripcion_cuenta">Descripción de la Cuenta</label>
                <?= $form->field($model, 'descripcion_cuenta')->textarea(['rows' => 2])->label(false) ?>
            </div>
            <div class="col-lg-3">
                <label for="bancos-status">Estado de la Cuenta</label>
                <?= $form->field($model, 'status')->widget(Select2::classname(), [
                    'data' => ['0' => 'Cuenta Inactiva', '1' => 'Cuenta Activa'],
                    'options' => ['placeholder' => 'Seleccione Estado'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])->label(false) ?>
            </div>
        </div>                
    </div>

    <div class="col-lg-12 mt-2 mb-2">
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
                </div>
            </div> 
        </div>                       
    </div>
    <?php ActiveForm::end(); ?>
</div>

<?php 
  $this->registerJs(" 
    $('#BtnOperador').click(function(e){    
      e.preventDefault();
      $('#nuevo_operador').modal('show')
      .find('#modalContent')
      .load($(this).attr('value'));
      return false;
    });
  ");
?> 