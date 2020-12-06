<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use kartik\date\DatePicker;
use yii\widgets\Pjax;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\CuponesListaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

Modal::begin([
  'title' => 'INFORMACIÓN DEL LISTADO DE CUPONES',
  'id' => 'ver_listado',
  'size' => 'modal-lg',
  'bodyOptions' => ['style' => 'top: 0px; padding:20px'],

]);

echo "<div id='modalContenedor'></div>";

Modal::end();

$this->title = 'Cupones de Descuento';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cupones-lista-index">
    <div class="card card-primary">
        <div class="card-header">Nueva Lista de Cupones</div>
        <div class="card-body">
            <?php $form = ActiveForm::begin(); ?>
            <div class="col-lg-12">
                <div class="row">

                    <div class="col-lg-8">
                        <div class="row mt-2">
                            <div class="col-lg-6">
                                <?= $form->field($model, 'descripcion')->textarea(['rows' => 1]) ?>
                            </div>

                            <div class="col-lg-2">
                                <?= $form->field($model, 'cantidad_cupones')->textInput() ?>
                            </div>

                            <div class="col-lg-2">
                                <?= $form->field($model, 'porcentaje_descuento')->textInput() ?>
                            </div>                        
                        </div>

                        <div class="row mt-2">
                            <div class="col-lg-4">
                                <label class="control-label">Fecha de Inicio</label>
                                <?= $form->field ($model , 'fecha_inicio' )->widget ( DatePicker::className () , [
                                    'type' => DatePicker::TYPE_COMPONENT_APPEND,
                                    'options' => [ 
                                        'placeholder' => '00-00-0000',
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

                            <div class="col-lg-4">
                                <label class="control-label">Fecha de Caducidad</label>
                                <?= $form->field ($model , 'fecha_fin' )->widget ( DatePicker::className () , [
                                    'type' => DatePicker::TYPE_COMPONENT_APPEND,
                                    'options' => [ 
                                        'placeholder' => '00-00-0000',
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
                    </div>
                    <div class="col-lg-3">
                        <?= Html::img('@web/img/cupones.png', ['class' => 'img-fluid img-coupon']) ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 mb-4">
                <div class="form-group">
                    <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

    <div class="card card-primary">
        <div class="card-header">Listado de Cupones de Descuento</div>
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
                            'width' => '450px',
                            'headerOptions' => ['style' => ['text-align' => 'center']],
                            'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                        ],

                        [
                            'attribute'=>'cantidad_cupones',                              
                            'width' => '200px',
                            'headerOptions' => ['style' => ['text-align' => 'center']],
                            'contentOptions' => ['style' => ['text-align' => 'center', 'vertical-align' => 'middle']],
                        ],                        

                        [
                            'attribute' => 'fecha_inicio',
                            'width' => '180px',
                            'headerOptions' => ['style' => ['text-align' => 'center']],
                            'contentOptions' => ['style' => ['text-align' => 'center', 'vertical-align' => 'middle']],
                            'value' => 'fecha_inicio',
                            'format' => 'date',
                            'filter' => DatePicker::widget([
                                'model' => $searchModel,
                                'attribute' => 'fecha_inicio',                               
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
                            'attribute' => 'fecha_fin',
                            'width' => '180px',
                            'headerOptions' => ['style' => ['text-align' => 'center']],
                            'contentOptions' => ['style' => ['text-align' => 'center', 'vertical-align' => 'middle']],
                            'value' => 'fecha_fin',
                            'format' => 'date',
                            'filter' => DatePicker::widget([
                                'model' => $searchModel,
                                'attribute' => 'fecha_fin',                               
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
                            'class' => 'yii\grid\ActionColumn', 
                            'contentOptions' => ['style' => ['vertical-align' => 'middle', 'width' => '150px']],
                            'template' => '<div align="center">{view} &nbsp;  {update} &nbsp;  {delete}</div>',
                            'buttons' => [ 
                                'view' => function ($url, $model, $key) {
                                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', '#', [
                                        'id' => 'view',
                                        'title' => Yii::t('app', 'Consultar'),
                                        'data-toggle' => 'modal',
                                        'data-target' => '#ver_listado',
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
    $(document).on('click', '#view', (function() {
      $.get(
        $(this).data('url'),
        function (data) {
          $('#modalContenedor').html(data);
          $('#ver_listado').modal();
        }
      );
    }));          
  ");
?> 
