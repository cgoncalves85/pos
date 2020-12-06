<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\RegistroPuntos */

if($model->status == 0) {
    $estado = '<span class="badge badge-danger">INACTIVO</span>';
} elseif ($model->status == 1) {
    $estado = '<span class="badge badge-success">ACTIVO</span>';
}

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Registro Puntos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="registro-puntos-view">
<div class="bonos-view">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-8">
                <?= Html::label('Monto', 'valor', ['class' => 'lbl-view']) ?>
                <?= Html::input('text', 'valor', '$ '.Yii::$app->formatter->asDecimal($model->valor), ['disabled' => true, 'class' => 'form-control text-bold']) ?>
            </div>
            <div class="col-lg-4">
                <?= Html::label('Cantidad de Puntos', 'cantidad_puntos', ['class' => 'lbl-view']) ?>
                <?= Html::input('text', 'cantidad_puntos', Yii::$app->formatter->asInteger($model->cantidad_puntos).' ptos.', ['disabled' => true, 'class' => 'form-control text-bold']) ?>
            </div>            
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
