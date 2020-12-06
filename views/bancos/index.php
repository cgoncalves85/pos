<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Modal;
use kartik\select2\Select2;
use app\models\BancoOperador;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\BancoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

Modal::begin([
  'title' => 'NUEVO OPERADOR BANCARIO',
  'id' => 'nuevo_operador',
  'size' => 'modal-md',
  'bodyOptions' => ['style' => 'top: 0px; padding:20px'],

]);

echo "<div id='modalContent'></div>";

Modal::end();

Modal::begin([
  'title' => 'INFORMACIÓN DE CUENTA BANCARIA',
  'id' => 'ver_cuenta',
  'size' => 'modal-md',
  'bodyOptions' => ['style' => 'top: 0px; padding:20px'],

]);

echo "<div id='modalContenedor'></div>";

Modal::end();

$this->title = 'Bancos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bancos-index">
    <div class="card card-primary">
        <div class="card-header">Nueva Cuenta Bancaria</div>
        <div class="card-body">
            <?php $form = ActiveForm::begin(); ?>
            <div class="col-lg-12 mt-2">
                <div class="row">
                    <div class="col-lg-4">
                        <?= $form->field($model, 'banco_operador_id')->widget(Select2::classname(), [
                            'data' => $bancos,
                            'options' => ['placeholder' => 'Seleccione Banco'],
                            'pluginOptions' => [
                              'allowClear' => true
                            ],
                        ]) ?>
                    </div>
                    <div class="col-lg-2" style="margin-top: 35px">
                        <?= Html::button('<i class="fas fa-plus"></i>', [                        
                            'value' => Yii::$app->urlManager->createUrl('/banco-operador/create'),
                            'class' => 'btn btn-success btn-sm',
                            'id' => 'BtnOperador',
                            'data-toggle'=> 'modal',
                            'data-target'=> '#nuevo_operador',
                        ]) ?>
                    </div>
                    <div class="col-lg-3">
                        <?= $form->field($model, 'nro_cuenta')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>
                    </div>
                    <div class="col-lg-3">
                        <?= $form->field($model, 'saldo_inicial', [
                            'inputTemplate' => '<div class="input-group"><div class="input-group-prepend"><span class="input-group-text"><b>$</b></span></div>{input}</div>',
                        ])->textInput(['maxlength' => true, 'placeholder' => 'Ingrese Monto', 'autocomplete' => 'off']) ?>
                    </div>                    
                </div>
            </div>

            <div class="col-lg-12 mt-2">
                <label for="bancos-descripcion_cuenta">Descripción de la Cuenta</label>
                <?= $form->field($model, 'descripcion_cuenta')->textarea(['rows' => 2])->label(false) ?>
            </div>

            <div class="col-lg-12 mt-2 mb-2">
                <div class="row">
                    <div class="col-lg-12">
                        <?= $form->field($model, 'status')->hiddenInput(['value' => 1])->label(false) ?>
                        <div class="form-group">
                            <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
                        </div>
                    </div> 
                </div>                       
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div> 
    
    <div class="card card-primary">
        <div class="card-header">Listado de Cuentas Bancarias</div>
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
                            'attribute' => 'banco_operador_id',
                            'format' => 'html',
                            'value' => function ($model) {
                                return '<b>'.$model->bancoOperador->nombre_banco.'</b>'; 
                            },  
                            'filter' => Select2::widget([
                                'model' => $searchModel,
                                'attribute' => 'banco_operador_id',
                                'data' => ArrayHelper::map(BancoOperador::find()->orderBy('nombre_banco')->all(), 'id', 'nombre_banco'),
                                'options' => [
                                    'placeholder' => ''
                                ],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]),
                            'width' => '300px',
                            'headerOptions' => ['style' => ['text-align' => 'center']],
                            'contentOptions' => ['style' => ['vertical-align' => 'middle']],      
                        ],                        

                        [
                            'attribute'=>'nro_cuenta',
                            'width' => '200px',
                            'headerOptions' => ['style' => ['text-align' => 'center']],
                            'contentOptions' => ['style' => ['text-align' => 'center', 'vertical-align' => 'middle']],
                        ],  

                        [
                            'attribute'=>'saldo_inicial',
                            'format' => 'html',
                            'value' => function ($model) {
                                return '<b>$ '.Yii::$app->formatter->asDecimal($model->saldo_inicial).'</b>'; 
                            },                             
                            'width' => '200px',
                            'headerOptions' => ['style' => ['text-align' => 'center']],
                            'contentOptions' => ['style' => ['text-align' => 'right', 'vertical-align' => 'middle']],
                        ],  

                        [
                            'attribute'=>'saldo_disponible',
                            'format' => 'html',
                            'value' => function ($model) {
                                return '<b>$ '.Yii::$app->formatter->asDecimal($model->saldo_disponible).'</b>'; 
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
                                        'data-target' => '#ver_cuenta',
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
    $('#BtnOperador').click(function(e){    
      e.preventDefault();
      $('#nuevo_operador').modal('show')
      .find('#modalContent')
      .load($(this).attr('value'));
      return false;
    });

    $(document).on('click', '#view', (function() {
      $.get(
        $(this).data('url'),
        function (data) {
          $('#modalContenedor').html(data);
          $('#ver_cuenta').modal();
        }
      );
    }));
  ");
?>    
