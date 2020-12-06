<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap4\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use app\models\Proveedores;
use app\models\OrdenProductos;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\OrdenCompraSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ordenes de Compras';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orden-compra-index">
    <div class="card card-primary">
        <div class="card-header">Nueva Orden de Compra</div>
        <div class="card-body">
            <?php $form = ActiveForm::begin([
                //'enableClientValidation' => false, //Evitar validaciones del lado del cliente
            ]); ?>

            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-3">
                        <?= $form->field($model->ordenCompra, 'nro_documento')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>
                    </div>
                    <div class="col-lg-4">
                        <?= $form->field($model->ordenCompra, 'proveedor_id')->widget(Select2::classname(), [
                            'data' => $proveedores,
                            'options' => ['placeholder' => 'Seleccione Proveedor'],
                            'pluginOptions' => [
                              'allowClear' => true
                            ],
                        ]) ?>
                    </div>
                    <div class="col-lg-2"></div>
                    <div class="col-lg-3">
                        <label class="control-label">Fecha</label>
                        <?= $form->field ($model->ordenCompra , 'fecha' )->widget ( DatePicker::className () , [
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

                <?php
                    //Cargar un producto por defecto
                    $producto = new OrdenProductos();
                    $producto->loadDefaultValues();
                ?>
                <div class="mt-4" id="venta-productos">
                    <div class="row" style="margin-bottom:16px;">
                        <div class="col-lg-6" style="padding-top: 5px">
                            <label>Listado de Productos</label>
                        </div>
                        <div align="right" class="col-lg-6">
                            <?= Html::a('<i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;&nbsp;Agregar Producto', 'javascript:void(0);', [
                                    'id' => 'venta-nuevo-producto-boton',
                                    'class' => 'btn btn-primary btn-sm'
                                ])
                            ?>
                        </div>
                        <div class="col-lg-12"><hr></div>
                    </div>
                    <!-- Cabeceras con etiquetas -->
                    <div class="row mt-4">
                        <div align="center" class="col-lg-1">
                            <label class="control-label">
                                <?= $producto->getAttributeLabel('cantidad') ?>
                            </label>
                        </div>
                        <div align="center" class="col-lg-6">
                            <label class="control-label">
                                <?= $producto->getAttributeLabel('producto_id') ?>
                            </label>
                        </div>             
                        <div align="center" class="col-lg-2">
                            <label class="control-label">
                                <?= $producto->getAttributeLabel('precio_compra') ?>
                            </label>
                        </div>
                        <div align="center" class="col-lg-2">
                            <label class="control-label">
                                <?= $producto->getAttributeLabel('precio_venta') ?>
                            </label>
                        </div>            
                        <div class="col-lg-1"></div>
                    </div>
                    <hr class="mt-0 mb-4">
                </div>

                <?php
                    //Recorrer los productos
                    foreach ($model->productos as $key => $_producto) {
                        //Para cada producto renderizar el formulario de producto
                        //Si el producto está vacío colocar 'nuevo' como clave, si no asignar el id del producto
                        echo '<tr>';
                        echo $this->render('_form-producto-orden', [
                            'key' => $_producto->isNewRecord ? (strpos($key, 'nuevo') !== false ? $key : 'nuevo' . $key) : $_producto->id,
                            'form' => $form,
                            'producto' => $_producto,
                        ]);
                        echo '</tr>';
                    }

                    //Producto vacío con su respectivo formulario que se utilizará para copiar cada vez que se presione el botón de nuevo producto
                    $producto = new OrdenProductos();
                    $producto->loadDefaultValues();
                    echo '<div id="venta-nuevo-producto-block" style="display:none">';
                    echo $this->render('_form-producto-orden', [
                        'key' => '__id__',
                        'form' => $form,
                        'producto' => $producto,
                    ]);
                    echo '</div>';
                ?>

                <?php ob_start(); ?>        

                <script>
                    //Crear la clave para el producto
                    var producto_k = <?php echo isset($key) ? str_replace('nuevo', '', $key) : 0; ?>;
                    //Al hacer click en el boton de nuevo producto aumentar en uno la clave
                    // y agregar un formulario de producto reemplazando la clave __id__ por la nueva clave
                    $('#venta-nuevo-producto-boton').on('click', function () {
                        producto_k += 1;
                        $('#venta-productos').append($('#venta-nuevo-producto-block').html().replace(/__id__/g, 'nuevo' + producto_k));
                    });

                    //Al hacer click en un botón de eliminar eliminar la fila más cercana
                    $(document).on('click', '.venta-eliminar-producto-boton', function () {
                        $(this).closest('.row').remove();
                    });
                </script>
                
                <?php $this->registerJs(str_replace(['<script>', '</script>'], '', ob_get_clean())); ?>

                <?= $form->field($model->ordenCompra, 'status')->hiddenInput(['value' => 1])->label(false) ?>
            </div>

            <div class="col-lg-12 mt-4">
                <div class="form-group mt-4">
                    <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

    <div class="card card-primary">
        <div class="card-header">Listado de Ordenes de Compra</div>
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
                            'attribute' => 'proveedor_id',
                            'format' => 'html',
                            'value' => function ($model) {
                                return '<b>'.$model->proveedor->razon_social.' ('.$model->proveedor->nombre.')</b>'; 
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
                            'width' => '400px',
                            'headerOptions' => ['style' => ['text-align' => 'center']],
                            'contentOptions' => ['style' => ['vertical-align' => 'middle']],      
                        ],
                        [
                            'attribute'=>'nro_documento',
                            'width' => '200px',
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
                            'attribute'=>'utilidad_total',
                            'width' => '200px',
                            'headerOptions' => ['style' => ['text-align' => 'center']],
                            'contentOptions' => ['style' => ['text-align' => 'right', 'vertical-align' => 'middle']],
                        ],                      

                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '<div align="center">{view} &nbsp;  {update} &nbsp;  {delete}</div>',
                            'contentOptions' => ['style' => ['vertical-align' => 'middle', 'width' => '120px']],
                        ],
                    ],
                ]); ?>

                <?php Pjax::end(); ?>
            </div>
        </div>
    </div>
</div>

<?php   
    $this->registerJs(" 
        $(document).ready(function() {
            items = $('#items').html();

            $('#btn-add').click(function() {
                
                $('#productos').prepend(items);

                // Agregamos un boton para retirar el formulario
                $('#btn-eliminar').prepend('<button id=btne class=btn-danger type=button>Eliminar</button>');
                $('#btne').addClass('btn btn-sm btn-retirar');

                $('#cant').focus();
            });

            $('#productos').on('click', '.btn-retirar', function(){
                $(this).closest('.item').remove();
            })

        });
    ");
?>