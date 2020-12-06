<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap4\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\MedidaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Unidades de Medida';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="medidas-index">
    <div class="card card-primary">
        <div class="card-header">Nueva Unidad de Medida</div>
        <div class="card-body">
            <?php $form = ActiveForm::begin(); ?>
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-4">
                        <?= $form->field($model, 'medida')->textInput(['maxlength' => true]) ?>
                    </div>

                    <div class="col-lg-2">
                        <?= $form->field($model, 'abv_med')->textInput(['maxlength' => true]) ?>
                    </div>          

                    <div class="col-lg-4">
                        <?= $form->field($model, 'status')->hiddenInput(['value' => 1])->label(false) ?>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-lg-1">     
                        <div class="form-group">
                            <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <?= Html::a('Cancelar', Yii::$app->request->referrer, ['class' => 'btn btn-danger']) ?>
                        </div>                        
                    </div>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

    <div class="card card-primary">
        <div class="card-header">Listado de Unidades de Medida</div>
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
                            'attribute'=>'medida',
                            'headerOptions' => ['style' => ['text-align' => 'center']],
                            'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                        ],                     

                        [
                            'attribute'=>'abv_med',
                            'width' => '150px',
                            'headerOptions' => ['style' => ['text-align' => 'center']],
                            'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                        ], 
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '<div align="center">{update} &nbsp;  {delete}</div>',
                            'contentOptions' => ['style' => ['vertical-align' => 'middle', 'width' => '100px']],
                        ],
                    ],
                ]); ?>

                <?php Pjax::end(); ?>
            </div>
        </div>
    </div>
</div>
