<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use kartik\select2\Select2;
use kartik\switchinput\SwitchInput;

/* @var $this yii\web\View */
/* @var $model app\models\Clientes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="clientes-form">
    <?php if ($model->isNewRecord) { ?>
        <?php $form = ActiveForm::begin(); ?>
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-6">
                    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true, 'placeholder' => 'Ingrese el Nombre del Cliente']) ?>
                </div>

                <div class="col-lg-3">
                    <?= $form->field($model, 'tipo_identificacion')->dropDownList([
                        'CC' => 'CC', 'NIT' => 'NIT', 'RUT' => 'RUT', 'CE' => 'CE',
                        'RUC' => 'RUC', 'PP' => 'PP', 'NIF' => 'NIF', 'CIF' => 'CIF',
                        'RIF' => 'RIF', 'RTN' => 'RTN', 'Cédula DIDI' => 'Cédula DIDI',
                        'Cédula DIMEX' => 'Cédula DIMEX',
                    ]) ?>
                </div>

                <div class="col-lg-3">
                    <?= $form->field($model, 'nro_identificacion')->textInput(['maxlength' => true]) ?>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-lg-6">
                    <?= $form->field($model, 'correo')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="col-lg-3">
                    <?= $form->field($model, 'telefono')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="col-lg-3">
                    <?= $form->field($model, 'movil')->textInput(['maxlength' => true]) ?>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-lg-5">
                    <?= $form->field($model, 'direccion')->textarea(['rows' => 2]) ?>
                </div>
                <div class="col-lg-3">
                    <?= $form->field($model, 'categoria_cliente_id')->widget(Select2::classname(), [
                        'data' => $categorias_cliente,
                            //'options' => ['placeholder' => 'Seleccione Categoria'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]) ?>
                </div>
                <div class="col-lg-1"></div>
                <div class="col-lg-3">
                    <label>Cliente Activo</label>
                    <?= $form->field($model, 'status')->widget(SwitchInput::classname(), [
                        'pluginOptions'=>[
                            'onText'=>'SI',
                            'offText'=>'NO'
                        ]
                    ])->label(false) ?>
                </div>                 
            </div>

            <div class="row mt-3">
                <div class="col-lg-12">
                    <div align="right" class="form-group">
                        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
                    </div>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    <?php } else { ?>
    <div class="card card-primary">
        <div class="card-header">Modificar Cliente</div>
        <div class="card-body">
            <?php $form = ActiveForm::begin(); ?>
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-5">
                        <?= $form->field($model, 'nombre')->textInput(['maxlength' => true, 'placeholder' => 'Ingrese el Nombre del Cliente']) ?>
                    </div>

                    <div class="col-lg-3">
                        <?= $form->field($model, 'tipo_identificacion')->dropDownList([
                            'CC' => 'CC', 'NIT' => 'NIT', 'RUT' => 'RUT', 'CE' => 'CE',
                            'RUC' => 'RUC', 'PP' => 'PP', 'NIF' => 'NIF', 'CIF' => 'CIF',
                            'RIF' => 'RIF', 'RTN' => 'RTN', 'Cédula DIDI' => 'Cédula DIDI',
                            'Cédula DIMEX' => 'Cédula DIMEX',
                        ]) ?>
                    </div>

                    <div class="col-lg-3">
                        <?= $form->field($model, 'nro_identificacion')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-lg-5">
                        <?= $form->field($model, 'correo')->textInput(['maxlength' => true]) ?>
                    </div>

                    <div class="col-lg-3">
                        <?= $form->field($model, 'telefono')->textInput(['maxlength' => true]) ?>
                    </div>

                    <div class="col-lg-3">
                        <?= $form->field($model, 'movil')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-lg-5">
                        <?= $form->field($model, 'direccion')->textarea(['rows' => 2]) ?>
                    </div>
                    <div class="col-lg-3">
                        <?= $form->field($model, 'categoria_cliente_id')->widget(Select2::classname(), [
                            'data' => $categorias_cliente,
                            //'options' => ['placeholder' => 'Seleccione Categoria'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]) ?>
                    </div>
                    <div class="col-lg-1"></div>
                    <div class="col-lg-3">
                        <label>Cliente Activo</label>
                        <?= $form->field($model, 'status')->widget(SwitchInput::classname(), [
                            'pluginOptions'=>[
                                'onText'=>'SI',
                                'offText'=>'NO'
                            ]
                        ])->label(false) ?>
                    </div>                     
                </div>

                <div class="row mt-3">
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
    <?php } ?>
</div>
