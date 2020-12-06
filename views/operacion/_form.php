<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Operacion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="operacion-form">
    <div class="card card-primary">
        <div class="card-header">Modificar Permiso</div>
        <div class="card-body">
            <?php $form = ActiveForm::begin(); ?>
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-md-4 ml-3">
                        <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
                    </div>                    
                </div>

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
    </div>
</div>
