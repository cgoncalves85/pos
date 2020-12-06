<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Modal;
use kartik\date\DatePicker;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Gastos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gastos-form">
    <div class="card card-primary">
        <div class="card-header">Modificar Gasto</div>
        <div class="card-body">
            <?php $form = ActiveForm::begin(); ?>
            <div class="col-lg-12">
                <div class="row mt-2">
                    <div class="col-lg-5">
                        <?= $form->field($model, 'descripcion')->textarea(['rows' => 2]) ?>
                    </div>
                    <div class="col-lg-3">
                        <?= $form->field($model, 'proveedor_id')->widget(Select2::classname(), [
                            'data' => $proveedores,
                            'options' => ['placeholder' => 'Seleccione Proveedor'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]) ?>
                    </div>
                    <div class="col-lg-1" style="margin-top: 35px">
                        <a href="" class="btn btn-primary btn-sm">Nuevo</a>
                    </div>
                    <div class="col-lg-3">
                        <?= $form->field ($model, 'fecha' )->widget ( DatePicker::className () , [
                            'type' => DatePicker::TYPE_COMPONENT_APPEND,
                            'options' => [ 
                                'placeholder' => 'Seleccione Fecha',
                                'autocomplete' => 'off',
                            ] ,
                            'pickerIcon' => '<i class="fas fa-calendar-alt text-primary"></i>',
                            'removeIcon' => '<i class="fas fa-trash text-danger"></i>',
                            'pluginOptions' => [
                                'format' => 'dd-mm-yyyy' ,
                                'todayHighlight' => true,
                                'autoclose' => true,
                            ]
                        ]) ?>
                    </div>                        
                </div>
            </div>

            <div class="col-lg-12">
                <div class="row mt-2">
                    <div class="col-lg-3">
                        <?= $form->field($model, 'tienda_id')->widget(Select2::classname(), [
                            'data' => $tiendas,
                            'options' => ['placeholder' => 'Seleccione Tienda'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]) ?>
                    </div>
                    <div class="col-lg-3">
                        <?= $form->field($model, 'forma_pago_id')->widget(Select2::classname(), [
                            'data' => $formas,
                            'options' => ['placeholder' => 'Seleccione Forma de Pago'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]) ?>
                    </div>
                    <div class="col-lg-3">
                        <?= $form->field($model, 'impuesto_id')->widget(Select2::classname(), [
                            'data' => $impuestos,
                            'options' => ['placeholder' => 'Seleccione Impuesto'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]) ?>
                    </div>                
                    <div class="col-lg-3">
                        <?= $form->field($model, 'monto', [
                            'inputTemplate' => '<div class="input-group"><div class="input-group-prepend"><span class="input-group-text"><b>$</b></span></div>{input}</div>',
                        ])->textInput(['maxlength' => true, 'placeholder' => 'Ingrese Monto', 'autocomplete' => 'off']) ?>
                    </div>                
                </div>
            </div>

            <div class="col-lg-12 mt-4"><hr></div>

            <div class="col-lg-12">
                <div class="row mt-4">
                    <div class="col-lg-3">
                        <?= $form->field($model, 'tipo_cuenta')->inline(false)->radioList($cuentas, ['name' => 'cuenta']) ?>
                    </div>
                    <div class="col-lg-9">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="row">
                                    <div class="col-lg-11">
                                        <?= $form->field($model, 'gastos_categorias_id')->widget(Select2::classname(), [
                                            'data' => $categorias,
                                            'options' => ['placeholder' => 'Seleccione Categoria'],
                                            'pluginOptions' => [
                                                'allowClear' => true
                                            ],
                                        ]) ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-11">
                                        <?=$form->field($model, 'gastos_subcategorias_id')->widget(DepDrop::classname(), [
                                            'type' => DepDrop::TYPE_SELECT2,
                                            'options' => [
                                                'id' => 'subcategoria_id', 
                                                'placeholder' => 'Seleccione Subcategoria',  
                                            ],
                                            'select2Options' => [                        
                                                'pluginOptions' => ['allowClear' => true]
                                            ],
                                            'pluginOptions' => [
                                                'placeholder' => 'Seleccione Subcategoria',
                                                'depends' => ['gastos-gastos_categorias_id'],
                                                'initialize' => $model->isNewRecord ? false : true,
                                                'url' => Url::to(['gastos/subcategorias']),
                                            ]
                                        ]) ?>
                                    </div>
                                </div>                            
                            </div>
                            <div class="col-lg-6">
                                 <div class="row">
                                    <div class="col-lg-8">
                                        <?= $form->field($model, 'banco_id')->widget(Select2::classname(), [
                                            'data' => $bancos,
                                            'disabled' => true,
                                            'options' => [
                                                'id' => 'banco',
                                                'placeholder' => 'Seleccione Banco'
                                            ],
                                            'pluginOptions' => [
                                                'allowClear' => true
                                            ],
                                        ]) ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-8">
                                        <label for="gastos-nro_referencia">N° de Referencia</label>
                                        <input type="text" id="referencia" name="Gastos[nro_referencia]" class="form-control" disabled="true" maxlength="true" value="<?= $model->nro_referencia ?>">
                                    </div>
                                </div>  
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 mb-4">
                <div class="row mt-4">
                    <div class="col-lg-6">
                        <?= $form->field($model, 'nota')->textarea(['rows' => 2]) ?>
                    </div>
                    <div class="col-lg-3">
                        <?= $form->field($model, 'status')->widget(Select2::classname(), [
                            'data' => ['0' => 'Inactivo', '1'=> 'Activo'],
                            'options' => ['placeholder' => 'Seleccione Estátus'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]) ?>
                    </div>
                    <div class="col-lg-2 mt-4" style="padding-top: 5px">
                        <div align="right" class="form-group">
                            <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
                        </div>
                    </div>                                        
                </div>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>