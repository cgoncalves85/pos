<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Modal;
use kartik\select2\Select2;
use app\models\MovBancarioTipo;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\MovBancarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

Modal::begin([
  'title' => 'NUEVO TIPO DE MOVIMIENTO BANCARIO',
  'id' => 'nuevo_tipo',
  'size' => 'modal-md',
  'bodyOptions' => ['style' => 'top: 0px; padding:20px'],

]);

echo "<div id='modalContent'></div>";

Modal::end();

Modal::begin([
  'title' => 'NUEVA CUENTA BANCARIA',
  'id' => 'nuevo_banco',
  'size' => 'modal-md',
  'bodyOptions' => ['style' => 'top: 0px; padding:20px'],

]);

echo "<div id='modalContent'></div>";

Modal::end();

Modal::begin([
  'title' => 'INFORMACIÓN DEL MOVIMIENTO BANCARIO',
  'id' => 'ver_movimiento',
  'size' => 'modal-md',
  'bodyOptions' => ['style' => 'top: 0px; padding:20px'],

]);

echo "<div id='modalContenedor'></div>";

Modal::end();

$this->title = 'Movimientos Bancarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mov-bancarios-index">
    <div class="card card-primary">
        <div class="card-header">Nuevo Movimiento Bancario</div>
        <div class="card-body">    
            <?php $form = ActiveForm::begin(); ?>
            <div class="row mt-2">
                <div class="col-lg-3">
                    <?= $form->field($model, 'nro_referencia')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>
                </div>                
                <div class="col-lg-3">
                    <?= $form->field($model, 'banco_id')->widget(Select2::classname(), [
                        'data' => $bancos,
                        'options' => ['placeholder' => 'Seleccione Banco'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]) ?>
                </div>
                <div class="col-lg-1" style="margin-top: 35px">
                    <?= Html::button('<i class="fas fa-plus"></i>', [                        
                        'value' => Yii::$app->urlManager->createUrl('/bancos/create'),
                        'class' => 'btn btn-success btn-sm',
                        'id' => 'BtnBancos',
                        'data-toggle'=> 'modal',
                        'data-target'=> '#nuevo_banco',
                    ]) ?>
                </div>

                <div class="col-lg-3">
                    <?= $form->field($model, 'tipo_movimiento_id')->widget(Select2::classname(), [
                        'data' => $tipos,
                        'options' => ['placeholder' => 'Seleccione Tipo de Movimiento'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]) ?>
                </div>
                <div class="col-lg-2" style="margin-top: 35px">
                    <?= Html::button('<i class="fas fa-plus"></i>', [                        
                        'value' => Yii::$app->urlManager->createUrl('/mov-bancario-tipo/create'),
                        'class' => 'btn btn-success btn-sm',
                        'id' => 'BtnTipo',
                        'data-toggle'=> 'modal',
                        'data-target'=> '#nuevo_tipo',
                    ]) ?>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-lg-3">
                    <?= $form->field($model, 'valor', [
                        'inputTemplate' => '<div class="input-group"><div class="input-group-prepend"><span class="input-group-text"><b>$</b></span></div>{input}</div>',
                    ])->textInput(['maxlength' => true]) ?>                    
                </div>

                <div class="col-lg-4">
                    <?= $form->field($model, 'observacion')->textarea(['rows' => 2]) ?>
                </div>

                <div class="col-lg-4">
                    <?= $form->field($model, 'nota_impresion')->textarea(['rows' => 2]) ?>
                </div>
                <?= $form->field($model, 'status')->hiddenInput(['value' => 1])->label(false) ?>
            </div>              


            <div class="row mt-4">
                <div class="col-lg-12">
                    <div class="form-group">
                        <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
                    </div>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

    <div class="card card-primary">
        <div class="card-header">Listado de Movimientos Bancarios</div>
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
                            'attribute' => 'banco_id',
                            'format' => 'html',
                            'value' => function ($model) {
                                return '<b>'.$model->banco->bancoOperador->nombre_banco.'</b><br>Cuenta Nº : '.$model->banco->nro_cuenta; 
                            },  
                            'filter' => Select2::widget([
                                'model' => $searchModel,
                                'attribute' => 'banco_id',
                                'data' => $bancos,
                                'options' => [
                                    'placeholder' => ''
                                ],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]),
                            'width' => '450px',
                            'headerOptions' => ['style' => ['text-align' => 'center']],
                            'contentOptions' => ['style' => ['vertical-align' => 'middle']],      
                        ],
                        
                        [
                            'attribute'=>'nro_referencia',
                            'width' => '250px',
                            'headerOptions' => ['style' => ['text-align' => 'center']],
                            'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                        ],

                        [
                            'attribute' => 'tipo_movimiento_id',
                            'format' => 'html',
                            'value' => function ($model) {
                                return $model->tipoMovimiento->descripcion; 
                            },  
                            'filter' => Select2::widget([
                                'model' => $searchModel,
                                'attribute' => 'tipo_movimiento_id',
                                'data' => ArrayHelper::map(MovBancarioTipo::find()->orderBy('descripcion')->all(), 'id', 'descripcion'),
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
                            'attribute'=>'valor',
                            'format' => 'html',
                            'value' => function ($model) {
                                return '<b>$ '.Yii::$app->formatter->asDecimal($model->valor).'</b>'; 
                            },                              
                            'width' => '200px',
                            'headerOptions' => ['style' => ['text-align' => 'center']],
                            'contentOptions' => ['style' => ['text-align' => 'right', 'vertical-align' => 'middle']],
                        ],

                        [ 
                            'class' => 'yii\grid\ActionColumn', 
                            'contentOptions' => ['style' => ['vertical-align' => 'middle', 'width' => '120px']],
                            'template' => '<div align="center">{view} &nbsp;  {update} &nbsp;  {delete}</div>',
                            'buttons' => [ 
                                'view' => function ($url, $model, $key) {
                                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', '#', [
                                        'id' => 'view',
                                        'title' => Yii::t('app', 'Consultar'),
                                        'data-toggle' => 'modal',
                                        'data-target' => '#ver_movimiento',
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
    $('#BtnTipo').click(function(e){    
      e.preventDefault();
      $('#nuevo_tipo').modal('show')
      .find('#modalContent')
      .load($(this).attr('value'));
      return false;
    });

    $('#BtnBancos').click(function(e){    
      e.preventDefault();
      $('#nuevo_banco').modal('show')
      .find('#modalContent')
      .load($(this).attr('value'));
      return false;
    });

    $(document).on('click', '#view', (function() {
      $.get(
        $(this).data('url'),
        function (data) {
          $('#modalContenedor').html(data);
          $('#ver_movimiento').modal();
        }
      );
    }));        
  ");
?> 