<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use kartik\switchinput\SwitchInput;

/* @var $this yii\web\View */
/* @var $model app\models\Inventario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="update-cupon">
    <div class="col-lg-12 mb-4">
        <?php $form = ActiveForm::begin(); ?>
        <div class="row">
            <?= $form->field($model, 'porcentaje_descuento')->hiddenInput(['maxlength' => true])->label(false) ?>
            <div class="col-lg-3">
                <?= $form->field($model, 'cupon')->textInput(['readonly' => true]) ?>
            </div>

            <div class="col-lg-9">
                <?= $form->field($model, 'descripcion')->textarea(['maxlength' => true]) ?>
            </div>
        </div>

        <div class="row mt-2">

            <div class="col-lg-2">
                <label>Descuento</label>
                <input type="text" class="form-control" value="<?= $model->porcentaje_descuento.' %' ?>" readonly>
            </div>

            <div class="col-lg-1"></div>

            <div class="col-lg-3">
                <label>Estado</label>
                <?= $form->field($model, 'status')->widget(SwitchInput::classname(), [
                    'pluginOptions'=>[
                        'onText'=>'Activo',
                        'offText'=>'Inactivo'
                    ]
                ])->label(false) ?>
            </div>

            <?php if ($model->status == 0) { ?>
                <div class="col-lg-4" style="margin-top: 30px">
                    <h5><label class="badge badge-danger text-uppercase">Este Cupón ya fué utilizado</label></h5>
                </div>
            <?php } ?>

            <?php if ($model->status == 1) { ?>
                <div class="col-lg-4" style="margin-top: 30px">
                    <h5><label class="badge badge-success text-uppercase">Este Cupón está Disponible</label></h5>
                </div>
            <?php } ?>            

            <div class="col-lg-2" style="margin-top: 30px">
                <div align="right" class="form-group">
                    <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>            
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
