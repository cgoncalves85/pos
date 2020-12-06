<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\grid\GridView;
use kartik\select2\Select2;
use kartik\switchinput\SwitchInput;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Modal;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\BonoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

Modal::begin([
  'title' => 'INFORMACIÓN DEL BONO',
  'id' => 'ver_premio',
  'size' => 'modal-md',
  'bodyOptions' => ['style' => 'top: 0px; padding:20px'],

]);

echo "<div id='modalContenedor'></div>";

Modal::end();

Modal::begin([
  'title' => 'MOFIFICAR BONO',
  'id' => 'modificar',
  'size' => 'modal-md',
  'bodyOptions' => ['style' => 'top: 0px; padding:20px'],

]);

echo "<div id='modalC'></div>";

Modal::end();

$this->title = 'Premios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bonos-index">
    <div class="card card-primary">
        <div class="card-header">Nuevo Premio</div>
        <div class="card-body">
            <?php $form = ActiveForm::begin(); ?>
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-2">
                        <?= $form->field($model, 'cantidad_puntos')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>
                    </div>
                    <div class="col-lg-1"></div>
                    <div class="col-lg-3">
                        <?= $form->field($model, 'tipo_bono')->widget(Select2::classname(), [
                            'data' => ['1' => 'Descuento', '2' => 'Premio'],
                            'options' => ['placeholder' => 'Seleccione Tipo de Bono'],
                            'pluginOptions' => [
                              'allowClear' => true
                            ],
                        ]) ?>                        
                    </div>
                    <div class="col-lg-1"></div>
                    <div id="premio" class="col-lg-4" style="display: none">
                        <?= $form->field($model, 'premio')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>                    
                    </div>
                    <div id="descuento" class="col-lg-2" style="display: none">
                        <?= $form->field($model, 'porcentaje_dcto')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>
                    </div>
                </div>

                <div class="row mt-2">   
                    <div class="col-lg-6">
                        <?= $form->field($model, 'observacion')->textarea(['rows' => 2]) ?>
                    </div>
                    <div class="col-lg-1"></div>
                    <div class="col-lg-3">
                        <?= $form->field($model, 'status')->widget(SwitchInput::classname(), [
                            'pluginOptions'=>[
                                'onText'=>'Activo',
                                'offText'=>'Inactivo'
                            ]
                        ]) ?>
                    </div>
                </div>
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
        <div class="card-header">Listado de Premios</div>
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
                            'attribute'=>'tipo_bono',
                            'format' => 'html',
                            'value' => function ($model) {
                                if($model->tipo_bono == 1) {
                                    $tipo_bono = '<span class="text-bold">Descuento - '.$model->porcentaje_dcto.' %</span>';
                                } elseif ($model->tipo_bono == 2) {
                                    $tipo_bono = '<span class="text-bold">Premio - '.$model->premio.'</span>';
                                }
                                return $tipo_bono;
                            }, 
                            'filter' => Select2::widget([
                                'model' => $searchModel,
                                'attribute' => 'tipo_bono',
                                'data' => [1 => 'Descuento', 2 => 'Premio'],
                                'options' => [
                                    'placeholder' => ''
                                ],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]),                                                         
                            'width' => '250px',
                            'headerOptions' => ['style' => ['text-align' => 'center']],
                            'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                        ], 

                        [
                            'attribute'=>'cantidad_puntos',
                            'format' => 'html',
                            'value' => function ($model) {
                                return Yii::$app->formatter->asInteger($model->cantidad_puntos).' <small class="x-small"> ptos.</small>'; 
                            },                
                            'width' => '150px',
                            'headerOptions' => ['style' => ['text-align' => 'center']],
                            'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                        ],

                        [
                            'attribute'=>'observacion',
                            'width' => '350px',
                            'headerOptions' => ['style' => ['text-align' => 'center']],
                            'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                        ], 

                        [
                            'attribute'=>'status',
                            'format' => 'html',
                            'value' => function ($model) {
                                if($model->status == 0) {
                                    $estado = '<span class="badge badge-danger">INACTIVO</span>';
                                } elseif ($model->status == 1) {
                                    $estado = '<span class="badge badge-success">ACTIVO</span>';
                                }
                                return '<b>'.$estado.'</b>';
                            }, 
                            'filter' => Select2::widget([
                                'model' => $searchModel,
                                'attribute' => 'status',
                                'data' => [0 => 'Inactivo', 1 => 'Activo'],
                                'options' => [
                                    'placeholder' => ''
                                ],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]),                                                         
                            'width' => '180px',
                            'headerOptions' => ['style' => ['text-align' => 'center']],
                            'contentOptions' => ['style' => ['text-align' => 'center', 'vertical-align' => 'middle']],
                        ],                                                                                                

                        [
                            'class' => 'yii\grid\ActionColumn',
                            'contentOptions' => ['style' => ['vertical-align' => 'middle', 'width' => '120px']],
                            'template' => '<div align="center">{view} &nbsp; {update} &nbsp;  {delete}</div>',
                            'buttons' => [ 
                                'view' => function ($url, $model, $key) {
                                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', '#', [
                                        'id' => 'view',
                                        'data-toggle' => 'modal',
                                        'title' => 'Consultar',
                                        'data-target' => '#ver_premio',
                                        'data-url' => Url::to(['view', 'id' => $model->id]),
                                        'data-pjax' => '0',
                                    ]);
                                },                       
                                'update' => function ($url, $model, $key) {
                                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', '#', [
                                        'id' => 'update',
                                        'data-toggle' => 'modal',
                                        'title' => 'Modificar',
                                        'data-target' => '#modificar',
                                        'data-url' => Url::to(['update', 'id' => $model->id]),
                                        'data-pjax' => '0',
                                    ]);
                                }, 
                                'delete'   
                            ]                             
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
        $(document).on('change', '#bonos-tipo_bono', function(event) {
            tipo = $('#bonos-tipo_bono').val();
            if (tipo == 1) {
                $('#premio').css('display','none')
                $('#descuento').css('display','inline-block')
                $('#bonos-porcentaje_dcto').attr('required', true)
            }
            if (tipo == 2) {
                $('#descuento').css('display','none')
                $('#premio').css('display','inline-block')
            }            
        });
        $(document).on('click', '#view', (function() {
            $.get(
                $(this).data('url'),
                function (data) {
                    $('#modalContenedor').html(data);
                    $('#ver_premio').modal();
                }
            );
        }));
        $(document).on('click', '#update', (function() {
            $.get(
                $(this).data('url'),
                function (data) {
                    $('#modalC').html(data);
                    $('#modificar').modal();
                }
            );
        }));                  
    ");
?>


