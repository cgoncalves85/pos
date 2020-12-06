<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Bancos */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Bancos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

if ($model->status == 0) {
    $estado = 'Cuenta Inactiva';
}

if ($model->status == 1) {
    $estado = 'Cuenta Activa';
}
?>
<div class="bancos-view">
    <div class="row">
        <div class="col-lg-12">
            <?= Html::label('Banco', 'banco_operador_id', ['class' => 'lbl-view']) ?>
            <?= Html::input('text', 'banco_operador_id', $model->bancoOperador->nombre_banco, ['disabled' => true, 'class' => 'form-control']) ?>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-6">
            <?= Html::label('N° de Cuenta', 'nro_cuenta', ['class' => 'lbl-view']) ?>
            <?= Html::input('text', 'nro_cuenta', $model->nro_cuenta, ['disabled' => true, 'class' => 'form-control']) ?>
        </div>
        <div class="col-lg-6">
            <?= Html::label('Estado', 'status', ['class' => 'lbl-view']) ?>
            <?= Html::input('text', 'status', $estado, ['disabled' => true, 'class' => 'form-control']) ?>
        </div>        
    </div>

    <div class="row mt-4">
        <div class="col-lg-12">
            <?= Html::label('Descripción', 'descripcion_cuenta', ['class' => 'lbl-view']) ?>
            <?= Html::textarea('descripcion_cuenta', $model->descripcion_cuenta, ['disabled' => true, 'class' => 'form-control']) ?>
        </div>        
    </div> 

    <div class="row mt-4">
        <div class="col-lg-6">
            <?= Html::label('Saldo Inicial', 'saldo_inicial', ['class' => 'lbl-view']) ?>
            <div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text"><b>$</b></span></div>
                <?= Html::input('text', 'saldo_inicial', Yii::$app->formatter->asDecimal($model->saldo_inicial), ['disabled' => true, 'class' => 'form-control text-bold', ]) ?>
            </div>
        </div>
        <div class="col-lg-6">
            <?= Html::label('Saldo Disponible', 'saldo_disponible', ['class' => 'lbl-view']) ?>
            <div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text"><b>$</b></span></div>
                <?= Html::input('text', 'saldo_disponible', Yii::$app->formatter->asDecimal($model->saldo_disponible), ['disabled' => true, 'class' => 'form-control text-bold', ]) ?>
            </div>
        </div>               
    </div>

    <div class="row mt-2 mb-4">  
        <div align="right" class="col-lg-12" style="margin-top: 35px">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
        </div>
    </div>
</div>
