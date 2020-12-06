<?php

use yii\helpers\Html;
use kartik\select2\Select2;
use kartik\switchinput\SwitchInput;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Bonos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bonos-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-5">
                <?= $form->field($model, 'cantidad_puntos')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-6">
                <?= $form->field($model, 'tipo_bono')->widget(Select2::classname(), [
                    'data' => ['1' => 'Descuento', '2' => 'Premio'],
                    'options' => ['placeholder' => 'Seleccione Tipo de Bono'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]) ?>                        
            </div>
        </div>

        <div class="row">
            <?php if ($model->tipo_bono == 1) { ?>
                <div id="premio" class="col-lg-12" style="display: none">
                    <?= $form->field($model, 'premio')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>
                </div>
                <div id="descuento" class="col-lg-4" style="display: inline-block;">
                    <?= $form->field($model, 'porcentaje_dcto')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>
                </div>
            <?php } if ($model->tipo_bono == 2) { ?>
                <div id="premio" class="col-lg-12" style="display: inline-block;">
                    <?= $form->field($model, 'premio')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>
                </div>
                <div id="descuento" class="col-lg-4" style="display: none;">
                    <?= $form->field($model, 'porcentaje_dcto')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>
                </div>
            <?php } ?>
        </div>

        <div class="row mt-2">   
            <div class="col-lg-12">
                <?= $form->field($model, 'observacion')->textarea(['rows' => 2]) ?>
            </div>
            <div class="col-lg-6">
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

<?php   
    $this->registerJs(" 
        $(document).on('change', '#bonos-tipo_bono', function(event) {
            tipo = $('#bonos-tipo_bono').val();
            if (tipo == 1) {
                $('#premio').css('display','none')
                $('#descuento').css('display','inline-block')
                $('#bonos-porcentaje_dcto').attr('required', true)
            }
            if (tipo == 2) {
                $('#descuento').css('display','none')
                $('#premio').css('display','inline-block')
            }            
        });                 
    ");
?>
