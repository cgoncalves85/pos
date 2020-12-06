<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Modal;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\MovBancarios */
/* @var $form yii\widgets\ActiveForm */

Modal::begin([
  'title' => 'NUEVO TIPO DE MOVIMIENTO BANCARIO',
  'id' => 'nuevo_tipo',
  'size' => 'modal-md',
  'bodyOptions' => ['style' => 'top: 0px; padding:20px'],

]);

echo "<div id='modalContent'></div>";

Modal::end();

Modal::begin([
  'title' => 'NUEVA CUENTA BANCARIA',
  'id' => 'nuevo_banco',
  'size' => 'modal-md',
  'bodyOptions' => ['style' => 'top: 0px; padding:20px'],

]);

echo "<div id='modalContent'></div>";

Modal::end();

?>

<div class="mov-bancarios-form">
    <div class="card card-primary">
        <div class="card-header">Modificar Movimiento Bancario</div>
        <div class="card-body">    
            <?php $form = ActiveForm::begin(); ?>
            <div class="row mt-2">
                <div class="col-lg-3">
                    <?= $form->field($model, 'nro_referencia')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>
                </div>                
                <div class="col-lg-3">
                    <?= $form->field($model, 'banco_id')->widget(Select2::classname(), [
                        'data' => $bancos,
                        'options' => ['placeholder' => 'Seleccione Banco'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]) ?>
                </div>
                <div class="col-lg-1" style="margin-top: 35px">
                    <?= Html::button('<i class="fas fa-plus"></i>', [                        
                        'value' => Yii::$app->urlManager->createUrl('/bancos/create'),
                        'class' => 'btn btn-success btn-sm',
                        'id' => 'BtnBancos',
                        'data-toggle'=> 'modal',
                        'data-target'=> '#nuevo_banco',
                    ]) ?>
                </div>

                <div class="col-lg-3">
                    <?= $form->field($model, 'tipo_movimiento_id')->widget(Select2::classname(), [
                        'data' => $tipos,
                        'options' => ['placeholder' => 'Seleccione Tipo de Movimiento'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]) ?>
                </div>
                <div class="col-lg-2" style="margin-top: 35px">
                    <?= Html::button('<i class="fas fa-plus"></i>', [                        
                        'value' => Yii::$app->urlManager->createUrl('/mov-bancario-tipo/create'),
                        'class' => 'btn btn-success btn-sm',
                        'id' => 'BtnTipo',
                        'data-toggle'=> 'modal',
                        'data-target'=> '#nuevo_tipo',
                    ]) ?>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-lg-3">
                    <?= $form->field($model, 'valor', [
                        'inputTemplate' => '<div class="input-group"><div class="input-group-prepend"><span class="input-group-text"><b>$</b></span></div>{input}</div>',
                    ])->textInput(['maxlength' => true]) ?>                    
                </div>

                <div class="col-lg-4">
                    <?= $form->field($model, 'observacion')->textarea(['rows' => 2]) ?>
                </div>

                <div class="col-lg-4">
                    <?= $form->field($model, 'nota_impresion')->textarea(['rows' => 2]) ?>
                </div>
                <?= $form->field($model, 'status')->hiddenInput(['value' => 1])->label(false) ?>
            </div>              


            <div class="row mt-4">
                <div class="col-lg-12">
                    <div class="form-group">
                        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
                    </div>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<?php 
  $this->registerJs(" 
    $('#BtnTipo').click(function(e){    
      e.preventDefault();
      $('#nuevo_tipo').modal('show')
      .find('#modalContent')
      .load($(this).attr('value'));
      return false;
    });

    $('#BtnBancos').click(function(e){    
      e.preventDefault();
      $('#nuevo_banco').modal('show')
      .find('#modalContent')
      .load($(this).attr('value'));
      return false;
    });        
  ");
?> 