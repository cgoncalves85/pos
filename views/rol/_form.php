<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Rol */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rol-form">
    <div class="card card-primary">
        <div class="card-header">Modificar Rol</div>
        <div class="card-body">
            <?php $form = ActiveForm::begin(); ?>
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-6">
                        <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 mt-2">
                        <label class="mb-4">Permisos Disponibles</label>
                        <?php $opciones = ArrayHelper::map($tipoOperaciones, 'id', 'descripcion'); ?>

                        <?= $form->field($model, 'operaciones')->checkboxList($opciones, [
                            'item' =>
                            function ($index, $label, $name, $checked, $value) {
                                return "<label class='col-md-4'>".Html::checkbox($name, $checked, [
                                    'value' => $value,
                                    'label' => '<label for="' . $label . '">' . $label . '</label>',
                                ])."</label>";
                            }, 
                            'separator' => false,
                        ])->label(false) ?>
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
