<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use kartik\date\DatePicker;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use yii\widgets\Pjax;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Modal;
use app\models\Proveedores;
use app\models\GastosCategorias;
use app\models\GastosSubcategorias;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\GastoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

Modal::begin([
  'title' => 'INFORMACIÓN DEL GASTO',
  'id' => 'ver_gasto',
  'size' => 'modal-lg',
  'bodyOptions' => ['style' => 'top: 0px; padding:20px'],

]);

echo "<div id='modalContenedor'></div>";

Modal::end();

Modal::begin([
  'title' => 'DATOS DEL NUEVO PROVEEDOR',
  'id' => 'nuevo_proveedor',
  'size' => 'modal-md',
  'bodyOptions' => ['style' => 'top: 0px; padding:20px'],

]);

echo "<div id='modalContent'></div>";

Modal::end();

$this->title = 'Gastos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gastos-index">
    <div class="card card-primary">
        <div class="card-header">Nuevo Gasto</div>
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
                        <?= Html::button('<i class="fas fa-plus"></i>', [                        
                            'value' => Yii::$app->urlManager->createUrl('/proveedores/create'),
                            'class' => 'btn btn-success btn-sm',
                            'id' => 'BtnProveedor',
                            'data-toggle'=> 'modal',
                            'data-target'=> '#nuevo_proveedor',
                        ]) ?>
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
                                        <input type="text" id="referencia" name="Gastos[nro_referencia]" class="form-control" disabled="true" maxlength="true">
                                    </div>
                                </div>  
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-6">
                        <?= $form->field($model, 'nota')->textarea(['rows' => 2]) ?>
                    </div>
                </div>
            </div>

            <?= $form->field($model, 'status')->hiddenInput(['value' => 1])->label(false) ?>

            <div class="col-lg-12 mt-4 mb-4">
                <div class="form-group">
                    <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

    <div class="card card-primary">
        <div class="card-header">Listado de Gastos</div>
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
                            'attribute'=>'descripcion',
                            'format' => 'html',
                            'value' => function ($model) {
                                return '<b>'.$model->descripcion.'</b>'; 
                            },                              
                            'width' => '250px',
                            'headerOptions' => ['style' => ['text-align' => 'center']],
                            'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                        ],

                        [
                            'attribute' => 'proveedor_id',
                            'format' => 'html',
                            'value' => function ($model) {
                                return '<b>'.$model->proveedor->nombre.'</b><br><div class=lbl-view>NIF/CIF : '.$model->proveedor->nif_cif.'</div>'; 
                            },  
                            'filter' => Select2::widget([
                                'model' => $searchModel,
                                'attribute' => 'proveedor_id',
                                'data' => ArrayHelper::map(Proveedores::find()->orderBy('nombre')->all(), 'id', 'nombre'),
                                'options' => [
                                    'placeholder' => ''
                                ],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]),
                            'width' => '350px',
                            'headerOptions' => ['style' => ['text-align' => 'center']],
                            'contentOptions' => ['style' => ['vertical-align' => 'middle']],      
                        ],                        

                        [
                            'attribute' => 'gastos_categorias_id',
                            'format' => 'html',
                            'value' => function ($model) {
                                return $model->gastosCategorias->categoria; 
                            },  
                            'filter' => Select2::widget([
                                'model' => $searchModel,
                                'attribute' => 'gastos_categorias_id',
                                'data' => ArrayHelper::map(GastosCategorias::find()->orderBy('categoria')->all(), 'id', 'categoria'),
                                'options' => [
                                    'placeholder' => ''
                                ],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]),
                            'width' => '200px',
                            'headerOptions' => ['style' => ['text-align' => 'center']],
                            'contentOptions' => ['style' => ['vertical-align' => 'middle']],      
                        ],  

                        [
                            'attribute' => 'gastos_subcategorias_id',
                            'format' => 'html',
                            'value' => function ($model) {
                                return $model->gastosSubcategorias->subcategoria; 
                            },  
                            'filter' => Select2::widget([
                                'model' => $searchModel,
                                'attribute' => 'gastos_subcategorias_id',
                                'data' => ArrayHelper::map(GastosSubcategorias::find()->orderBy('subcategoria')->all(), 'id', 'subcategoria'),
                                'options' => [
                                    'placeholder' => ''
                                ],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]),
                            'width' => '200px',
                            'headerOptions' => ['style' => ['text-align' => 'center']],
                            'contentOptions' => ['style' => ['vertical-align' => 'middle']],      
                        ],  

                        [
                            'attribute'=>'monto',
                            'format' => 'html',
                            'value' => function ($model) {
                                return '<b>$ '.Yii::$app->formatter->asDecimal($model->monto).'</b>'; 
                            },                              
                            'width' => '150px',
                            'headerOptions' => ['style' => ['text-align' => 'center']],
                            'contentOptions' => ['style' => ['text-align' => 'right', 'vertical-align' => 'middle']],
                        ],                                                                     

                        [ 
                            'class' => 'yii\grid\ActionColumn', 
                            'contentOptions' => ['style' => ['vertical-align' => 'middle', 'width' => '150px']],
                            'template' => '<div align="center">{view} &nbsp;  {update} &nbsp;  {delete}</div>',
                            'buttons' => [ 
                                'view' => function ($url, $model, $key) {
                                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', '#', [
                                        'id' => 'view',
                                        'title' => Yii::t('app', 'Consultar'),
                                        'data-toggle' => 'modal',
                                        'data-target' => '#ver_gasto',
                                        'data-url' => Url::to(['view', 'id' => $model->id]),
                                        'data-pjax' => '0',
                                    ]);
                                },                       
                                'update',
                                'delete'   
                            ] 
                        ]
                    ],
                ]); ?>

                <?php Pjax::end(); ?>
            </div>
        </div>
    </div>
</div>

<?php 
  $this->registerJs(" 
    $('input[name=cuenta]').click(function () {    
        opcion = $(this).val();
        if (opcion == 1) {
            $('#banco').attr('disabled', true);
            $('#referencia').attr('disabled', true);
        }
        if (opcion == 2) {
            $('#banco').attr('disabled', false);
            $('#referencia').attr('disabled', false);
        }
    });

    $('#BtnProveedor').click(function(e){    
      e.preventDefault();
      $('#nuevo_proveedor').modal('show')
      .find('#modalContent')
      .load($(this).attr('value'));
      return false;
    });    

    $(document).on('click', '#view', (function() {
      $.get(
        $(this).data('url'),
        function (data) {
          $('#modalContenedor').html(data);
          $('#ver_gasto').modal();
        }
      );
    }));          
  ");
?>  

