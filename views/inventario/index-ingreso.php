<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap4\ActiveForm;
use kartik\grid\GridView;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use yii\widgets\Pjax;
use app\models\Tiendas;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\InventarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Inventarios - Ingresos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inventario-index-ingreso">
    <div class="card card-primary">
        <div class="card-header">Nuevo Ingreso de Mercancia</div>
        <div class="card-body">
            <?php $form = ActiveForm::begin(); ?>
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-3">
                        <?= $form->field($model, 'nro_documento')->textInput(['maxlength' => true]) ?>
                    </div>

                    <div class="col-lg-3">
                        <label class="control-label">Fecha de Ingreso</label>
                        <?= $form->field ($model , 'fecha' )->widget ( DatePicker::className () , [
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
                        ] )->label(false) ?>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-lg-3">
                        <?= $form->field($model, 'orden_compra_id')->widget(Select2::classname(), [
                            'data' => $ordenes,
                            'options' => ['placeholder' => 'Seleccione Orden de Compra'],
                            'pluginOptions' => [
                              'allowClear' => true
                            ],
                        ]) ?> 
                    </div>                      
                    <div class="col-lg-6">
                        <label class="control-label">Observación</label>
                        <?= $form->field($model, 'observacion')->textarea(['rows' => '2', 'maxlength' => true])->label(false) ?>
                    </div>
                </div>

                <?= $form->field($model, 'status')->hiddenInput(['value' => 1])->label(false) ?>
                <?= $form->field($model, 'tipo_movimiento')->hiddenInput(['maxlength' => true, 'value' => 'INGRESO', 'readonly' => true])->label(false) ?>                
            </div>

            <div class="col-lg-12 mt-2">
                <div class="form-group">
                    <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

    <div class="card card-primary">
        <div class="card-header">Listado de Ingreso de Mercancia</div>
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
                            'attribute'=>'nro_documento',
                            'format' => 'html',
                            'value' => function ($model) {
                                return '<b>Ingreso N° : '.$model->nro_documento.'</b><br>'.$model->observacion; 
                            },                              
                            'width' => '450px',
                            'headerOptions' => ['style' => ['text-align' => 'center']],
                            'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                        ],                                               

                        [
                            'attribute' => 'fecha',
                            'width' => '200px',
                            'headerOptions' => ['style' => ['text-align' => 'center']],
                            'contentOptions' => ['style' => ['text-align' => 'center', 'vertical-align' => 'middle']],
                            'value' => 'fecha',
                            'format' => 'date',
                            'filter' => DatePicker::widget([
                                'model' => $searchModel,
                                'attribute' => 'fecha',                               
                                'type' => DatePicker::TYPE_INPUT,
                                'options' => ['autocomplete' => 'off', 'style' => ['text-align' => 'center']],
                                'pluginOptions' => [
                                    'format' => 'yyyy-mm-dd',
                                    'autoclose' => true,
                                    'startView' => 'days',
                                    'todayHighlight' => true,
                                ]
                            ])
                        ],

                        [
                            'attribute'=>'orden_compra_id',
                            'format' => 'html',
                            'value' => function ($model) {
                                return '<b>'.$model->ordenCompra->nro_documento.'</b>'; 
                            },                              
                            'width' => '150px',
                            'headerOptions' => ['style' => ['text-align' => 'center']],
                            'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                        ],                       

                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '<div align="center">{delete}</div>',
                            'contentOptions' => ['style' => ['vertical-align' => 'middle', 'width' => '180px']],
                        ],
                    ],
                ]); ?>

                <?php Pjax::end(); ?>
            </div>
        </div>
    </div>
</div>
