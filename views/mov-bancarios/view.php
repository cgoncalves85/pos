<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MovBancarios */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Mov Bancarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="mov-bancarios-view">
    <div class="row">
        <div class="col-lg-12">
            <?= Html::label('Banco', 'banco_id', ['class' => 'lbl-view']) ?>
            <?= Html::input('text', 'banco_id', $model->banco->bancoOperador->nombre_banco, ['disabled' => true, 'class' => 'form-control']) ?>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-6">
            <?= Html::label('N° de Referencia', 'nro_referencia', ['class' => 'lbl-view']) ?>
            <?= Html::input('text', 'nro_referencia', $model->nro_referencia, ['disabled' => true, 'class' => 'form-control']) ?>
        </div>
        <div class="col-lg-6">
            <?= Html::label('Tipo de Movimiento', 'tipo_movimiento_id', ['class' => 'lbl-view']) ?>
            <?= Html::input('text', 'tipo_movimiento_id', $model->tipoMovimiento->descripcion, ['disabled' => true, 'class' => 'form-control']) ?>
        </div>        
    </div>

    <div class="row mt-4">
        <div class="col-lg-12">
            <?= Html::label('Observación', 'observacion', ['class' => 'lbl-view']) ?>
            <?= Html::textarea('observacion', $model->observacion, ['disabled' => true, 'class' => 'form-control']) ?>
        </div>        
    </div> 

    <div class="row mt-2">
        <div class="col-lg-12">
            <?= Html::label('Nota de Impresión', 'nota_impresion', ['class' => 'lbl-view']) ?>
            <?= Html::textarea('nota_impresion', $model->nota_impresion, ['disabled' => true, 'class' => 'form-control']) ?>
        </div>        
    </div>

    <div class="row mt-2 mb-4">
        <div class="col-lg-6">
            <?= Html::label('Monto', 'valor', ['class' => 'lbl-view']) ?>
            <div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text"><b>$</b></span></div>
                <?= Html::input('text', 'valor', Yii::$app->formatter->asDecimal($model->valor), ['disabled' => true, 'class' => 'form-control text-bold', ]) ?>
            </div>
        </div>  
        <div align="right" class="col-lg-6" style="margin-top: 35px">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
        </div>
    </div>
</div>
