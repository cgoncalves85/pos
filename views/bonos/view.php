<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Bonos */
if ($model->tipo_bono == 1) {
    $tipo_bono = 'Descuento';
}

if ($model->tipo_bono == 2) {
    $tipo_bono = 'Premio';
}

if($model->status == 0) {
    $estado = '<span class="badge badge-danger">INACTIVO</span>';
} elseif ($model->status == 1) {
    $estado = '<span class="badge badge-success">ACTIVO</span>';
}

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Bonos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="bonos-view">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-7">
                <?= Html::label('Tipo de Bono', 'tipo_bono', ['class' => 'lbl-view']) ?>
                <?= Html::input('text', 'tipo_bono', $tipo_bono, ['disabled' => true, 'class' => 'form-control text-bold']) ?>
            </div>
            <div class="col-lg-5">
                <?= Html::label('Cantidad de Puntos', 'cantidad_puntos', ['class' => 'lbl-view']) ?>
                <?= Html::input('text', 'cantidad_puntos', $model->cantidad_puntos, ['disabled' => true, 'class' => 'form-control']) ?>
            </div>            
        </div>

        <div class="row mt-4">
            <?php if ($model->tipo_bono == 1) { ?>
                <div class="col-lg-4">
                    <?= Html::label('Descuento (%)', 'porcentaje_dcto', ['class' => 'lbl-view']) ?>
                    <?= Html::input('text', 'porcentaje_dcto', $model->porcentaje_dcto.' %', ['disabled' => true, 'class' => 'form-control']) ?>
                </div>
            <?php } 
                if ($model->tipo_bono == 2) { ?>
                <div class="col-lg-12">
                    <?= Html::label('Descripción del Premio', 'premio', ['class' => 'lbl-view']) ?>
                    <?= Html::input('text', 'premio', $model->premio, ['disabled' => true, 'class' => 'form-control']) ?>
                </div>
            <?php } ?>           
        </div>

        <div class="row mt-4">
            <div class="col-lg-12">
                <?= Html::label('Observaciones', 'observacion', ['class' => 'lbl-view']) ?>
                <textarea class="form-control" disabled="true" rows="2"><?= $model->observacion ?></textarea>            
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-lg-12">
                <?= Html::label('Estado :', 'status', ['class' => 'lbl-view mr-1']) ?>
                <?= $estado ?>           
            </div>
            <div align="right" class="col-lg-12 mb-3">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
            </div>            
        </div>
    </div>
</div>
