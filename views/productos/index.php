<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap4\ActiveForm;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ProductoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Productos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="productos-index">
    <div class="card card-primary">
        <div class="card-header">Nuevo Producto</div>
        <div class="card-body">    
            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
            <div class="col-lg-12">
                <div class="row mt-2">
                    <div class="col-lg-5">    
                        <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
                    </div>

                    <div class="col-lg-2">    
                        <?= $form->field($model, 'codigo')->textInput(['maxlength' => true]) ?>
                    </div>

                    <div class="col-lg-3">
                        <?= $form->field($model, 'precio')->textInput(['maxlength' => true]) ?>
                    </div> 

                    <div class="col-lg-2">    
                        <?= $form->field($model, 'impuesto_id')->widget(Select2::classname(), [
                            'data' => $impuestos,
                            'options' => ['placeholder' => 'Seleccione Imp.'],
                            'pluginOptions' => [
                              'allowClear' => true
                            ],
                        ]) ?>
                    </div>                               

                </div>

                <div class="row mt-3">
                    <div class="col-lg-3"> 
                        <?= $form->field($model, 'categoria_id')->widget(Select2::classname(), [
                            'data' => $categorias,
                            'options' => ['placeholder' => 'Seleccione Categoria'],
                            'pluginOptions' => [
                              'allowClear' => true
                            ],
                        ]) ?>
                    </div>

                    <div class="col-lg-2">  
                        <?= $form->field($model, 'medida_id')->widget(Select2::classname(), [
                            'data' => $medidas,
                            'options' => ['placeholder' => 'Seleccione Medida'],
                            'pluginOptions' => [
                              'allowClear' => true
                            ],
                        ]) ?>
                    </div>

                    <div class="col-lg-2">    
                        <?= $form->field($model, 'stock_minimo')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>
                    </div>

                    <div class="col-lg-2">    
                        <?= $form->field($model, 'stock_maximo')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>
                    </div>

                    <div class="col-lg-3">
                        <?php /* <?= $form->field($model, 'image')->fileInput() ?> */ ?>
                        <div><label>Imágen del Producto</label></div>
                        <input type="file" style="display:none;" id="file" name="Productos[image]"/>
                        <button type="button" onclick="document.getElementById('file').click();" class="btn btn-default btn-outline-wac"><?= Html::img('@web/img/icons/upload.png') ?>Cargar Imágen</button>                        
                    </div>
                </div>

                <div class="row mt-3">
                  
                </div>                
                <?= $form->field($model, 'status')->hiddenInput(['value' => 1])->label(false) ?>

                <div class="row mt-4">
                    <div class="col-lg-1">     
                        <div class="form-group">
                            <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <?= Html::a('Administrar Unid. de Medida', ['medidas/index'], ['class' => 'btn btn-success']) ?>
                        </div>                        
                    </div>
                </div>
            </div>
            <?php ActiveForm::end(); ?>

        </div>
    </div>

    <div class="card card-primary">
        <div class="card-header">Listado de Productos</div>
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
                            'attribute'=>'imagen',
                            'format' => 'html',
                            'value' => function ($model) {
                                return '<img class="img-thumbnail img-grid" src='.$model->getImageUrl().'>'; 
                            },
                            'width' => '150px',
                            'headerOptions' => ['style' => ['text-align' => 'center']],
                            'contentOptions' => ['style' => ['text-align' => 'center', 'vertical-align' => 'middle']],
                        ],  
                        [
                            'attribute'=>'nombre',
                            'format' => 'html',
                            'value' => function ($model) {
                                return '<b>'.$model->nombre.'</b><br>Código : '.$model->codigo; 
                            },                
                            'width' => '250px',
                            'headerOptions' => ['style' => ['text-align' => 'center']],
                            'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                        ], 
                        [
                            'attribute'=>'categoria_id',
                            'value' => 'categoria.categoria',
                            'width' => '250px',
                            'headerOptions' => ['style' => ['text-align' => 'center']],
                            'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                        ],             

                        [
                            'attribute'=>'medida_id',
                            'format' => 'html',
                            'value' => function ($model) {
                                return $model->medida->medida.' ('.$model->medida->abv_med.')'; 
                            },                
                            'width' => '250px',
                            'headerOptions' => ['style' => ['text-align' => 'center']],
                            'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                        ],                           

                        [
                            'attribute'=>'precio',
                            'format' => 'html',
                            'value' => function ($model) {
                                return '<b>$ '.Yii::$app->formatter->asDecimal($model->precio).'</b><br>Impuesto : '.$model->impuesto->valor.' %'; 
                            },                
                            'width' => '250px',
                            'headerOptions' => ['style' => ['text-align' => 'center']],
                            'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                        ],                         

                        //echo Yii::$app->formatter->asCurrency(105, "$"),"<br>";                        

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