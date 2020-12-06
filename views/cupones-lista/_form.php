<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\ActiveForm;
use kartik\date\DatePicker;
use kartik\switchinput\SwitchInput;
use kartik\select2\Select2;
use yii\bootstrap4\Modal;

/* @var $this yii\web\View */
/* @var $model app\models\CuponesLista */
/* @var $form yii\widgets\ActiveForm */

Modal::begin([
  'title' => 'MODIFICAR CUPÓN',
  'id' => 'modificar',
  'size' => 'modal-lg',
  'bodyOptions' => ['style' => 'top: 0px; padding:20px'],

]);

echo "<div id='modalContenedor'></div>";

Modal::end();

?>

<div class="cupones-lista-form">
    <div class="card card-primary">
        <div class="card-header">Modificar Lista de Cupones</div>
        <div class="card-body">
            <?php $form = ActiveForm::begin(); ?>
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="row mt-2">            
                            <div class="col-lg-10">
                                <?= $form->field($model, 'descripcion')->textarea(['rows' => 1]) ?>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-lg-5">
                                <label class="control-label">Fecha de Inicio</label>
                                <?= $form->field ($model , 'fecha_inicio' )->widget ( DatePicker::className () , [
                                    'type' => DatePicker::TYPE_COMPONENT_APPEND,
                                    'options' => [ 
                                        'placeholder' => '00-00-0000',
                                        'autocomplete' => 'off',
                                    ] ,
                                    'pickerIcon' => '<i class="fas fa-calendar-alt text-primary"></i>',
                                    'removeIcon' => '<i class="fas fa-trash text-danger"></i>',
                                    'pluginOptions' => [
                                     'format' => 'dd-mm-yyyy' ,
                                     'todayHighlight' => true,
                                     'autoclose' => true,
                                 ]
                             ] )->label(false) ?>
                            </div>

                            <div class="col-lg-5">
                                <label class="control-label">Fecha de Caducidad</label>
                                <?= $form->field ($model , 'fecha_fin' )->widget ( DatePicker::className () , [
                                    'type' => DatePicker::TYPE_COMPONENT_APPEND,
                                    'options' => [ 
                                        'placeholder' => '00-00-0000',
                                        'autocomplete' => 'off',
                                    ] ,
                                    'pickerIcon' => '<i class="fas fa-calendar-alt text-primary"></i>',
                                    'removeIcon' => '<i class="fas fa-trash text-danger"></i>',
                                    'pluginOptions' => [
                                     'format' => 'dd-mm-yyyy' ,
                                     'todayHighlight' => true,
                                     'autoclose' => true,
                                 ]
                             ] )->label(false) ?>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-lg-4">
                                <?= $form->field($model, 'cantidad_cupones')->textInput(['readonly' => true]) ?>
                            </div>
                            <div class="col-lg-1"></div>                        
                            <div class="col-lg-4">
                                <label>Lista Activa</label>
                                <?= $form->field($model, 'status')->widget(SwitchInput::classname(), [
                                    'pluginOptions'=>[
                                        'onText'=>'Sí',
                                        'offText'=>'No'
                                    ]
                                ])->label(false) ?>
                            </div>                       
                        </div>

                        <div class="row mt-3">
                            <div class="col-lg-10">
                                <label>Observación</label>
                                <textarea class="form-control">Lista de Cupones con Descuento de <?= $listaCupones[0]->porcentaje_descuento ?>%</textarea>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-lg-10">
                                <div class="form-group mt-4">
                                    <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card mt-4 mr-4">
                            <div class="card-body card-cupon p-4">
                                <label class="form-group">Listado de Cupones</label>
                                <table class="table table-fluid table-striped table-bordered table-cupones">
                                    <thead align="center">
                                        <th>N°</th>
                                        <th>CUPÓN</th>
                                        <th></th>
                                    </thead>
                                    <tbody>
                                        <?php for ($i=0; $i < count($listaCupones); $i++) { ?>
                                            <tr align="center">
                                                <td style="vertical-align: middle;"><?= $i+1; ?></td>
                                                <td>
                                                    <?php if ($listaCupones[$i]->status == 0) {?>
                                                        <div class="content-cupon bg-red"><?= $listaCupones[$i]->cupon ?></div>
                                                    <?php } else { ?>
                                                        <div class="content-cupon"><?= $listaCupones[$i]->cupon ?></div>
                                                    <?php } ?>                                                    
                                                </td>
                                                
                                                <td style="vertical-align: middle;">
                                                    <?= Html::a('<i class="far fa-edit"></i>', '#', [
                                                        'id' => 'update',
                                                        'title' => 'Modificar Cupón',
                                                        'style' => ['color' => 'primary'],
                                                        'data-toggle' => 'modal',
                                                        'data-target' => '#modificar',
                                                        'data-url' => Url::to(['update-cupon', 'id' => $listaCupones[$i]->id]),
                                                        'data-pjax' => '0',
                                                    ]) ?>  
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<?php 
  $this->registerJs("   
    $(document).on('click', '#update', (function() {
      $.get(
        $(this).data('url'),
        function (data) {
          $('#modalContenedor').html(data);
          $('#modificar').modal();
        }
      );
    }));          
  ");
?>
