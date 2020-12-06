<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use kartik\select2\Select2;
use yii\widgets\Pjax;
use app\models\Tiendas;
use app\models\Productos;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ExistenciaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Existencias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="existencias-index">
    <div class="card card-primary">
        <div class="card-header">Listado de Productos en Existencia</div>
        <div class="card-body">
            <div class="col-lg-12">
                <?php Pjax::begin(); ?>
                <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

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
                            'attribute' => 'producto_id',
                            'format' => 'html',
                            'value' => function ($model) {
                                return '<b>'.$model->producto->nombre.'</b><br>Código : '.$model->producto->codigo; 
                            },  
                            'filter' => Select2::widget([
                                'model' => $searchModel,
                                'attribute' => 'producto_id',
                                'data' => ArrayHelper::map(Productos::find()->orderBy('nombre')->all(), 'id', 'nombre'),
                                'options' => [
                                    'placeholder' => ''
                                ],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]),
                            'headerOptions' => ['style' => ['text-align' => 'center']],
                            'contentOptions' => ['style' => ['vertical-align' => 'middle']],      
                        ], 

                        [
                            'attribute'=>'cantidad',
                            'format' => 'html',
                            'value' => function ($model) {
                                return '<b>'.$model->cantidad.'</b>'; 
                            },                             
                            'width' => '150px',
                            'headerOptions' => ['style' => ['text-align' => 'center']],
                            'contentOptions' => ['style' => ['text-align' => 'right', 'vertical-align' => 'middle']],
                        ], 
                    ],
                ]); ?>

                <?php Pjax::end(); ?>
            </div>
        </div>
    </div>
</div>
