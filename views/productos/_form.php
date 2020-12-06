<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Productos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="productos-form">
    <div class="card card-primary">
        <div class="card-header">Modificar Producto</div>
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
</div>
