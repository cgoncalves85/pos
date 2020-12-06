<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Cajas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cajas-form">
    <div class="card card-primary">
        <div class="card-header">Modificar Caja</div>
        <div class="card-body">
            <?php $form = ActiveForm::begin(); ?>
            <div class="col-lg-12">
                <div class="row">
                    <div align="center" class="col-lg-1">
                        <?= $form->field($model, 'nro')->textInput(['maxlength' => true, 'style' => ['text-align' => 'center']]) ?> 
                    </div>
                    <div class="col-lg-6">
                        <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>
                    </div>

                    <div class="col-lg-4">
                        <?= $form->field($model, 'tienda_id')->widget(Select2::classname(), [
                            'data' => $tiendas,
                            'options' => ['placeholder' => 'Seleccione Tienda'],
                            'pluginOptions' => [
                              'allowClear' => true
                            ],
                        ]) ?> 
                    </div>
                </div>
            </div>
            <?= $form->field($model, 'status')->hiddenInput(['value' => 1])->label(false) ?>

            <div class="col-lg-12 mt-2">
                <div class="form-group">
                    <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?> 
        </div>
    </div>
</div>
