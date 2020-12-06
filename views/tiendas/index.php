<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap4\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\TiendaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tiendas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tiendas-index">
    <div class="card card-primary">
        <div class="card-header">Nueva Tienda</div>
        <div class="card-body">
            <?php $form = ActiveForm::begin(); ?>
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-2">            
                        <?= $form->field($model, 'codigo')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-lg-5">
                        <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-lg-5">
                        <?= $form->field($model, 'razon_social')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="row">
                            <div class="col-lg-12">
                                <?= $form->field($model, 'direccion')->textarea(['rows' => 5, 'style' => ['height' => '125px']]) ?>
                            </div>
                            <div class="col-lg-6">
                                <?= $form->field($model, 'contacto')->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-lg-6">
                                <?= $form->field($model, 'correo')->textInput(['maxlength' => true]) ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="row">
                            <div class="col-lg-6">            
                                <?= $form->field($model, 'nif_cif')->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-lg-6">
                                <?= $form->field($model, 'telefono')->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-lg-6">
                                <?= $form->field($model, 'movil')->textInput(['maxlength' => true]) ?>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
            <?= $form->field($model, 'status')->hiddenInput(['value' => 1])->label(false) ?>

            <div class="col-lg-12 mt-4">
                <div class="form-group">
                    <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

    <div class="card card-primary">
        <div class="card-header">Listado de Tiendas</div>
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
                            'attribute'=>'codigo',
                            'width' => '150px',
                            'format' => 'html',
                            'value' => function ($model) {
                                return '<b>'.$model->codigo.'</b>'; 
                            },                             
                            'headerOptions' => ['style' => ['text-align' => 'center']],
                            'contentOptions' => ['style' => ['text-align' => 'center', 'vertical-align' => 'middle']],
                        ],
                        [
                            'attribute'=>'nombre',
                            'format' => 'html',
                            'value' => function ($model) {
                                return '<b>'.$model->razon_social.' - '.$model->nombre.'</b><br>NIT/RUT : '.$model->nif_cif; 
                            },                
                            'width' => '250px',
                            'headerOptions' => ['style' => ['text-align' => 'center']],
                            'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                        ], 

                        [
                            'attribute'=>'contacto',
                            'format' => 'html',
                            'value' => function ($model) {
                                return '<b>'.$model->contacto.'</b><br>Teléfonos : '.$model->telefono.' / '.$model->movil; 
                            },                
                            'width' => '400px',
                            'headerOptions' => ['style' => ['text-align' => 'center']],
                            'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                        ],

                        [
                            'attribute'=>'correo',
                            'format' => 'html',
                            'value' => function ($model) {
                                return '<a href="mailto:'.$model->correo.'">'.$model->correo.'</a>'; 
                            },
                            'width' => '200px',
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
