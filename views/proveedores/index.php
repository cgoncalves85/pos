<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap4\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ProveedorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Proveedores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proveedores-index">
    <div class="card card-primary">
        <div class="card-header">Nuevo Proveedor</div>
        <div class="card-body">
            <?php $form = ActiveForm::begin(); ?>
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-6">            
                        <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-lg-6">
                        <?= $form->field($model, 'razon_social')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-lg-3">
                        <?= $form->field($model, 'nif_cif')->textInput(['maxlength' => true]) ?>
                    </div>

                    <div class="col-lg-3">
                        <?= $form->field($model, 'correo')->textInput(['maxlength' => true]) ?>
                    </div>

                    <div class="col-lg-3">
                        <?= $form->field($model, 'telefono')->textInput(['maxlength' => true]) ?>
                    </div>

                    <div class="col-lg-3">
                        <?= $form->field($model, 'movil')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-lg-3">
                        <?= $form->field($model, 'contacto')->textInput(['maxlength' => true]) ?>
                    </div>

                    <div class="col-lg-9">
                        <label for="proveedores-direccion">Dirección / Domicilio FIscal</label>
                        <?= $form->field($model, 'direccion')->textarea(['rows' => 2])->label(false) ?>
                    </div>
                </div>
                <?= $form->field($model, 'status')->hiddenInput(['value' => 1])->label(false) ?>

                <div class="row mt-3">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
                        </div>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>

    <div class="card card-primary">
        <div class="card-header">Listado de Proveedores</div>
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
                            'attribute'=>'razon_social',
                            'format' => 'html',
                            'value' => function ($model) {
                                return '<b>'.$model->razon_social.' ('.$model->nombre.')</b><br>NIF/CIF : '.$model->nif_cif; 
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
                            'width' => '250px',
                            'headerOptions' => ['style' => ['text-align' => 'center']],
                            'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                        ],                         
                        
                        [
                            'attribute'=>'correo',
                            'format' => 'html',
                            'value' => function ($model) {
                                return '<a href="mailto:'.$model->correo.'">'.$model->correo.'</a>'; 
                            },
                            'width' => '150px',
                            'headerOptions' => ['style' => ['text-align' => 'center']],
                            'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                        ],                          

                        [
                            'attribute'=>'direccion',
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
