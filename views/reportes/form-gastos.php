<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Tiendas */

\yii\web\YiiAsset::register($this);
?>
<div class="reportes-gastos">
    <?php $form = ActiveForm::begin(['options' => ['name' => 'form-gastos']]); ?>

    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-7">
                <label class="lbl-view">Categoria del Gasto</label>
                <?= Select2::widget([
                    'name' => 'producto_id',
                    'data' => $categorias,
                    'options' => ['placeholder' => 'Seleccione la Categoria'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]) ?>
            </div>            
            <div class="col-lg-5">
                <label class="lbl-view">Mes</label>
                <?= Select2::widget([
                    'name' => 'mes',
                    'data' => ['01' => 'Enero', '02' => 'Febrero', '03' => 'Marzo', '04' => 'Abril', '05' => 'Mayo', '06' => 'Junio', '07' => 'Julio', '08' => 'Agosto', '09' => 'Septiembre', '10' => 'Octubre', '11' => 'Noviembre', '12' => 'Diciembre'],
                    'options' => ['placeholder' => 'Seleccione el Mes'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]) ?>
            </div>
        </div>    
    </div>

    <div class="col-lg-12 mt-4 mb-2">
        <div align="right" class="form-group">
            <?= Html::submitButton('Generar Reporte', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>
