<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$caja = $buscaCierre->caja->descripcion;
$fecha = date('d-m-Y', strtotime($buscaCierre->fecha));

/* @var $this yii\web\View */
/* @var $model app\models\CajasApertura */
/* @var $form ActiveForm */

$this->title = 'Cierre de Caja';
?>
<div class="ventas-cierre">
    <div class="card card-primary">
        <div class="card-header">Cierre de Caja</div>
        <div class="card-body">
            <?php $form = ActiveForm::begin(); ?>
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-3">
                        <label>Caja</label>
                        <input type="text" class="form-control" name="caja" readonly="true" value="<?= $caja ?>">
                    </div>

                    <div class="col-lg-3">
                        <label>Monto de Apertura</label>
                        <input type="text" class="form-control" name="monto_apertura" readonly="true" value="<?= $buscaCierre->monto_apertura ?>">
                    </div>                    

                    <div class="col-lg-4"></div>

                    <div class="col-lg-2">
                        <label>Fecha</label>
                        <input type="text" class="form-control" name="fecha" readonly="true" value="<?= $fecha ?>">
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-lg-3">
                        <?= $form->field($buscaCierre, 'monto_cierre')->textInput() ?>
                    </div>                    
                </div>
            </div>

            <div class="col-lg-12 mt-4">
                <div class="form-group">
                    <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>            

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div><!-- ventas-apertura -->
