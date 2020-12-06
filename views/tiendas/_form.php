<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Tiendas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tiendas-form">
    <div class="card card-primary">
        <div class="card-header">Modificar Tienda</div>
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
</div>
