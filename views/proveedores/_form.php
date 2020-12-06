<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Proveedores */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="proveedores-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="col-lg-12">
        <?php if ($model->isNewRecord) { ?> 
            <div class="row">
                <div class="col-lg-12">
                    <label class="lbl-view">Nombre Comercial</label>
                    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true])->label(false) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <label class="lbl-view">Razón Social</label>
                    <?= $form->field($model, 'razon_social')->textInput(['maxlength' => true])->label(false) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <label class="lbl-view">NIF/CIF</label>
                    <?= $form->field($model, 'nif_cif')->textInput(['maxlength' => true])->label(false) ?>
                </div>
                <div class="col-lg-6">
                    <label class="lbl-view">Correo Electrónico</label>
                    <?= $form->field($model, 'correo')->textInput(['maxlength' => true])->label(false) ?>
                </div>                
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <label class="lbl-view">Teléfono</label>
                    <?= $form->field($model, 'telefono')->textInput(['maxlength' => true])->label(false) ?>
                </div>
                <div class="col-lg-6">
                    <label class="lbl-view">Móvil</label>
                    <?= $form->field($model, 'movil')->textInput(['maxlength' => true])->label(false) ?>
                </div>                
            </div> 

            <div class="row">
                <div class="col-lg-8">
                    <label class="lbl-view">Contacto</label>
                    <?= $form->field($model, 'contacto')->textInput(['maxlength' => true])->label(false) ?>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <label class="lbl-view">Dirección / Domicilio Fiscal</label>
                    <?= $form->field($model, 'direccion')->textarea(['rows' => 2])->label(false) ?>
                </div>                
            </div>                        

        <?php } else { ?> 

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
                    <?= $form->field($model, 'direccion')->textarea(['rows' => 2]) ?>
                </div>
            </div>
        <?php } ?>
        
        <?= $form->field($model, 'status')->hiddenInput(['value' => 1])->label(false) ?>

        <div class="row mt-3">
            <div class="col-lg-12">
                <div class="form-group">
                    <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
