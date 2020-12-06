<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap4\ActiveForm;
use kartik\select2\Select2;
use kartik\switchinput\SwitchInput;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ClientesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Clientes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clientes-index">
    <div class="card card-primary">
        <div class="card-header">Nuevo Cliente</div>
        <div class="card-body">
            <?php $form = ActiveForm::begin(); ?>
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-5">
                        <?= $form->field($model, 'nombre')->textInput(['maxlength' => true, 'placeholder' => 'Ingrese el Nombre del Cliente']) ?>
                    </div>

                    <div class="col-lg-3">
                        <?= $form->field($model, 'tipo_identificacion')->widget(Select2::classname(), [
                            'data' => [
                                'CC' => 'CC', 'NIT' => 'NIT', 'RUT' => 'RUT', 'CE' => 'CE',
                                'RUC' => 'RUC', 'PP' => 'PP', 'NIF' => 'NIF', 'CIF' => 'CIF',
                                'RIF' => 'RIF', 'RTN' => 'RTN', 'Cédula DIDI' => 'Cédula DIDI',
                                'Cédula DIMEX' => 'Cédula DIMEX'
                            ],
                            'options' => ['placeholder' => 'Seleccione Tipo'],
                            'pluginOptions' => [
                              'allowClear' => true
                            ],
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

    <div class="card card-primary">
        <div class="card-header">Listado de Clientes</div>
        <div class="card-body">
            <div class="col-lg-12">
                <?php Pjax::begin(); ?>
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'responsive' => true,
                    'responsiveWrap' => false,
                    'persistResize' => false,        
                    'columns' => [
                        [                      
                            'header' => 'N°',
                            'class' => 'kartik\grid\SerialColumn'
                        ], 

                        [
                            'attribute'=>'nombre',
                            'format' => 'html',
                            'value' => function ($model) {
                                return '<b>'.$model->nombre.'</b><br>'.$model->tipo_identificacion.' : '.$model->nro_identificacion; 
                            },                
                            'width' => '250px',
                            'headerOptions' => ['style' => ['text-align' => 'center']],
                            'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                        ], 
                        [
                            'attribute'=>'telefono',
                            'width' => '150px',
                            'headerOptions' => ['style' => ['text-align' => 'center']],
                            'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                        ],   
                        [
                            'attribute'=>'movil',
                            'width' => '150px',
                            'headerOptions' => ['style' => ['text-align' => 'center']],
                            'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                        ],

                        [
                            'attribute'=>'correo',
                            'format' => 'html',
                            'value' => function ($model) {
                                return '<a href="mailto:'.$model->correo.'">'.$model->correo.'</a>'; 
                            },
                            'width' => '150px',
                            'headerOptions' => ['style' => ['text-align' => 'center']],
                            'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                        ],                          

                        [
                            'attribute'=>'direccion',
                            'headerOptions' => ['style' => ['text-align' => 'center']],
                            'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                        ], 

                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '<div align="center">{update} &nbsp;  {delete}</div>',
                            'contentOptions' => ['style' => ['vertical-align' => 'middle', 'width' => '100px']],
                        ],
                    ],
                ]); ?>

                <?php Pjax::end(); ?>
            </div>
        </div>
    </div>
</div>
