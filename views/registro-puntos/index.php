<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\grid\GridView;
use kartik\select2\Select2;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Modal;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\RegistroPuntoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

Modal::begin([
  'title' => 'INFORMACIÓN DE REGISTRO DE PUNTOS',
  'id' => 'ver_puntos',
  'size' => 'modal-md',
  'bodyOptions' => ['style' => 'top: 0px; padding:20px'],

]);

echo "<div id='modalContenedor'></div>";

Modal::end();

Modal::begin([
  'title' => 'MODIFICAR REGISTRO DE PUNTOS',
  'id' => 'modificar',
  'size' => 'modal-md',
  'bodyOptions' => ['style' => 'top: 0px; padding:20px'],

]);

echo "<div id='modalC'></div>";

Modal::end();

$this->title = 'Registro de Puntos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="registro-puntos-index">
    <div class="card card-primary">
        <div class="card-header">Nuevo Registro de Puntos</div>
        <div class="card-body">
            <?php $form = ActiveForm::begin(); ?>
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-3">
                        <?= $form->field($model, 'valor')->textInput(['maxlength' => true, 'autocomplete' => 'off', 'placeholder' => 'Ej. 50000']) ?>
                    </div> 
                    <div class="col-lg-1"></div>
                    <div class="col-lg-2">
                        <label>Cantidad de Puntos</label>
                        <?= $form->field($model, 'cantidad_puntos')->textInput(['maxlength' => true, 'autocomplete' => 'off', 'placeholder' => 'Ej. 20'])->label(false) ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 mt-3">
                <div class="form-group">
                    <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?> 
        </div>
    </div>

    <div class="card card-primary">
        <div class="card-header">Listado de Registro de Puntos</div>
        <div class="card-body">
            <div class="col-lg-12">
                <?php Pjax::begin(); ?>
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'responsiveWrap' => false,
                    'persistResize' => false,        
                    'columns' => [
                        [                      
                            'header' => 'N°',
                            'class' => 'kartik\grid\SerialColumn'
                        ],

                        [
                            'attribute'=>'cantidad_puntos',
                            'format' => 'html',
                            'value' => function ($model) {
                                return Yii::$app->formatter->asInteger($model->cantidad_puntos).'<small class="x-small"> ptos.</small>'; 
                            },                
                            'width' => '200px',
                            'headerOptions' => ['style' => ['text-align' => 'center']],
                            'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                        ],                        

                        [
                            'attribute'=>'valor',
                            'format' => 'html',
                            'value' => function ($model) {
                                return '$ '.Yii::$app->formatter->asDecimal($model->valor); 
                            },                
                            'width' => '250px',
                            'headerOptions' => ['style' => ['text-align' => 'center']],
                            'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                        ],                         

                        [
                            'attribute'=>'observacion',
                            'format' => 'html',
                            'value' => function ($model) {
                                return $model->observacion; 
                            },                
                            'width' => '450px',
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
                                        'data-target' => '#ver_puntos',
                                        'data-url' => Url::to(['view', 'id' => $model->id]),
                                        'data-pjax' => '0',
                                    ]);
                                },                       
                                'update' => function ($url, $model, $key) {
                                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', '#', [
                                        'id' => 'update',
                                        'data-toggle' => 'modal',
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
        $(document).on('click', '#view', (function() {
            $.get(
                $(this).data('url'),
                function (data) {
                    $('#modalContenedor').html(data);
                    $('#ver_puntos').modal();
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
