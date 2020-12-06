<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap4\ActiveForm;
use kartik\select2\Select2;
use app\models\Tiendas;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\CajaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cajas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cajas-index">
    <div class="card card-primary">
        <div class="card-header">Nueva Caja</div>
        <div class="card-body">
            <?php $form = ActiveForm::begin(); ?>
            <div class="col-lg-12">
                <div class="row">
                    <div align="center" class="col-lg-1">
                        <?= $form->field($model, 'nro')->textInput(['maxlength' => true, 'style' => ['text-align' => 'center']]) ?> 
                    </div>
                    <div class="col-lg-6">
                        <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>
                    </div>

                    <div class="col-lg-4">
                        <?= $form->field($model, 'tienda_id')->widget(Select2::classname(), [
                            'data' => $tiendas,
                            'options' => ['placeholder' => 'Seleccione Tienda'],
                            'pluginOptions' => [
                              'allowClear' => true
                            ],
                        ]) ?> 
                    </div>
                </div>
            </div>
            <?= $form->field($model, 'status')->hiddenInput(['value' => 1])->label(false) ?>

            <div class="col-lg-12 mt-2">
                <div class="form-group">
                    <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?> 
        </div>
    </div>

    <div class="card card-primary">
        <div class="card-header">Listado de Cajas</div>
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
                            'attribute'=>'nro',
                            'format' => 'html',
                            'value' => function ($model) {
                                return '<b>'.$model->nro.'</b>'; 
                            },                              
                            'width' => '100px',
                            'headerOptions' => ['style' => ['text-align' => 'center']],
                            'contentOptions' => ['style' => ['text-align' => 'center', 'vertical-align' => 'middle']],
                        ],

                        [
                            'attribute'=>'descripcion',
                            'width' => '450px',
                            'headerOptions' => ['style' => ['text-align' => 'center']],
                            'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                        ],

                        [
                            'attribute' => 'tienda_id',
                            'format' => 'html',
                            'value' => function ($model) {
                                return $model->tienda->razon_social.' - '.$model->tienda->nombre; 
                            },  
                            'filter' => Select2::widget([
                                'model' => $searchModel,
                                'attribute' => 'tienda_id',
                                'data' => ArrayHelper::map(Tiendas::find()->orderBy('nombre')->all(), 'id', 'nombre'),
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
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '<div align="center">{update} &nbsp;  {delete}</div>',
                            'contentOptions' => ['style' => ['vertical-align' => 'middle', 'width' => '120px']],
                        ],
                    ],
                ]); ?>

                <?php Pjax::end(); ?>
            </div>
        </div>
    </div>
</div>
