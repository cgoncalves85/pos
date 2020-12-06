<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use kartik\select2\Select2;
use kartik\export\ExportMenu;
use yii\widgets\Pjax;
use app\models\Clientes;
use app\models\Cajas;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\VentaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Histórico de Ventas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ventas-index">
    <div class="card card-primary">
        <div class="card-header">Histórico de Ventas</div>
        <div class="card-body pt-4">
            <p align="right">
                <?= Html::a('Nueva Venta', ['vender'], ['class' => 'btn btn-primary']) ?>
            </p>

            <?php Pjax::begin(); ?>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?php
                $gridColumns = [
                    [                      
                        'header' => 'N°',
                        'class' => 'kartik\grid\SerialColumn'
                    ],

                    [
                        'attribute' => 'cliente_id',
                        'format' => 'html',
                        'value' => function ($model) {
                            return '<b>'.$model->cliente->nombre.'</b> <br>'.$model->cliente->tipo_identificacion.' : '.$model->cliente->nro_identificacion;
                        },  
                        'filter' => Select2::widget([
                            'model' => $searchModel,
                            'attribute' => 'cliente_id',
                            'data' => ArrayHelper::map(Clientes::find()->orderBy('nombre')->all(), 'id', 'nombre'),
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
                        'attribute'=>'nro_documento',
                        'width' => '150px',
                        'headerOptions' => ['style' => ['text-align' => 'center']],
                        'contentOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],
                    ],
                    [
                        'attribute' => 'caja_id',
                        'format' => 'html',
                        'value' => function ($model) {
                            return $model->caja->descripcion; 
                        },  
                        'filter' => Select2::widget([
                            'model' => $searchModel,
                            'attribute' => 'caja_id',
                            'data' => ArrayHelper::map(Cajas::find()->orderBy('descripcion')->all(), 'id', 'descripcion'),
                            'options' => [
                                'placeholder' => ''
                            ],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]),
                        'width' => '150px',
                        'headerOptions' => ['style' => ['text-align' => 'center']],
                        'contentOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'center']],      
                    ], 
                    [
                        'attribute'=>'total',
                        'format' => 'html',
                        'value' => function ($model) {
                            return '<b>$ '.Yii::$app->formatter->asDecimal($model->total).'</b>'; 
                        },                
                        'width' => '150px',
                        'headerOptions' => ['style' => ['text-align' => 'center']],
                        'contentOptions' => ['style' => ['vertical-align' => 'middle', 'text-align' => 'right']],
                    ],

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '<div align="center">{view} &nbsp;  {update} &nbsp;  {delete}</div>',
                        'contentOptions' => ['style' => ['vertical-align' => 'middle', 'width' => '110px']],
                    ],
                ]
            ?>            

            <div class="mb-4" style="margin-top: -55px">
            <?= ExportMenu::widget([
                'dataProvider' => $dataProvider,
                'columns' => $gridColumns
            ]); ?>
            </div>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'responsive' => true,
                'responsiveWrap' => false,
                'persistResize' => false,
                'columns' => $gridColumns        

            ]); ?>

            <?php Pjax::end(); ?>
        </div>
    </div>
</div>
