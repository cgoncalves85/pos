<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use kartik\select2\Select2;
use kartik\date\DatePicker;

$fecha = date('d-m-Y');

/* @var $this yii\web\View */
/* @var $model app\models\CajasApertura */
/* @var $form ActiveForm */

$this->title = 'Apertura de Caja';

?>
<div class="ventas-apertura">
    <div class="card card-primary">
        <div class="card-header">Apertura de Caja</div>
        <div class="card-body">
            <?php $form = ActiveForm::begin(); ?>
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-3">
                        <?= $form->field($model, 'caja_id')->widget(Select2::classname(), [
                            'data' => $cajas,
                            'options' => ['placeholder' => 'Seleccione Caja'],
                            'pluginOptions' => [
                              'allowClear' => true
                            ],
                        ]) ?>
                    </div>

                    <div class="col-lg-3">
                        <?= $form->field($model, 'monto_apertura') ?>
                    </div>

                    <div class="col-lg-4"></div>
                    <div class="col-lg-2">
                        <?= $form->field($model, 'fecha')->textInput(['value' => $fecha, 'readonly' => true]) ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4">
                        
                    </div>
                </div>
            </div>

            <div class="col-lg-12 mt-4">
                <div class="form-group">
                    <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>            

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div><!-- ventas-apertura -->
