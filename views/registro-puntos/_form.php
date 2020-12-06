<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use kartik\switchinput\SwitchInput;

/* @var $this yii\web\View */
/* @var $model app\models\RegistroPuntos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="registro-puntos-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-6">
                <?= $form->field($model, 'valor')->textInput(['maxlength' => true, 'autocomplete' => 'off', 'placeholder' => 'Ej. 50000']) ?>
            </div> 
            <div class="col-lg-1"></div>
            <div class="col-lg-4">
                <label>Cantidad de Puntos</label>
                <?= $form->field($model, 'cantidad_puntos')->textInput(['maxlength' => true, 'autocomplete' => 'off', 'placeholder' => 'Ej. 20'])->label(false) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <?= $form->field($model, 'status')->widget(SwitchInput::classname(), [
                    'pluginOptions'=>[
                        'onText'=>'Activo',
                        'offText'=>'Inactivo'
                    ]
                ]) ?>
            </div>
        </div>        
    </div>

    <div class="col-lg-12">
        <div align="right" class="form-group">
            <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?> 
</div>
