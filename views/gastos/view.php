<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Gastos */

$dir_proveedor = $model->proveedor->direccion;
$nif_cif = $model->proveedor->nif_cif;
$telefonos = $model->proveedor->telefono.' / '.$model->proveedor->movil;
$mail = $model->proveedor->correo;
$datos = '<b>Dirección : </b>'.$dir_proveedor.'<br><b>Teléfonos :</b> '.$telefonos.'<br><b>Correo Electrónico :</b> '.$mail;

$fecha = date('d-m-Y', strtotime($model->fecha));

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Gastos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="gastos-view">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-12">
                        <?= Html::label('Descripción del Gasto', 'descripcion', ['class' => 'lbl-view']) ?>
                        <?= Html::input('text', 'descripcion', $model->descripcion, ['disabled' => true, 'class' => 'form-control text-bold']) ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <?= Html::label('Proveedor', 'proveedor_id', ['class' => 'lbl-view']) ?>
                <?= Html::input('text', 'proveedor_id', $model->proveedor->nombre, ['disabled' => true, 'class' => 'form-control']) ?>
            </div>

            <div class="col-lg-12 mt-4 mb-3">
                <div class="row">
                    <div class="col-lg-12">
                        <?= Html::label('Datos del Proveedor', 'datos_proveedor', ['class' => 'lbl-view']) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="content-info-view"><?= '<b>Dirección : </b>'.$dir_proveedor ?></div>
                    </div>
                    <div class="col-lg-6">
                        <div class="content-info-view"><?= '<b>Teléfonos : </b>'.$telefonos ?></div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-lg-6">
                        <div class="content-info-view"><?= '<b>NIF/CIF : </b>'.$nif_cif ?></div>
                    </div>
                    <div class="col-lg-6">
                        <div class="content-info-view"><?= '<b>Email : </b>'.$mail ?></div>
                    </div>
                </div>                
            </div>

            <div class="col-lg-12 mt-2">
                <div class="row">
                    <div class="col-lg-3">
                        <?= Html::label('Fecha', 'fecha', ['class' => 'lbl-view']) ?>
                        <?= Html::input('text', 'fecha', $fecha, ['disabled' => true, 'class' => 'form-control']) ?>
                    </div>
                    <div class="col-lg-3">
                        <?= Html::label('Impuesto', 'impuesto_id', ['class' => 'lbl-view']) ?>
                        <?= Html::input('text', 'impuesto_id', $model->impuesto->valor.' %', ['disabled' => true, 'class' => 'form-control']) ?>
                    </div>                    
                    <div class="col-lg-6">
                        <?= Html::label('Tienda', 'tienda_id', ['class' => 'lbl-view']) ?>
                        <?= Html::input('text', 'tienda_id', $model->tienda->nombre, ['disabled' => true, 'class' => 'form-control']) ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 mt-4">
                <div class="row">
                    <div class="col-lg-6">
                        <?= Html::label('Categoria del Gasto', 'gastos_categorias_id', ['class' => 'lbl-view']) ?>
                        <?= Html::input('text', 'gastos_categorias_id', $model->gastosCategorias->categoria, ['disabled' => true, 'class' => 'form-control']) ?>
                    </div>                    
                    <div class="col-lg-6">
                        <?= Html::label('Subcategoria', 'gastos_subcategorias_id', ['class' => 'lbl-view']) ?>
                        <?= Html::input('text', 'gastos_subcategorias_id', $model->gastosSubcategorias->subcategoria, ['disabled' => true, 'class' => 'form-control']) ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 mt-4">
                <div class="row">
                    <div class="col-lg-6">
                        <?= Html::label('Forma de Pago', 'forma_pago_id', ['class' => 'lbl-view']) ?>
                        <?= Html::input('text', 'forma_pago_id', $model->formaPago->descripcion, ['disabled' => true, 'class' => 'form-control']) ?>
                    </div>                    
                    <div class="col-lg-6">
                        <?= Html::label('Monto', 'monto', ['class' => 'lbl-view']) ?>
                        <?= Html::input('text', 'monto', '$ '.Yii::$app->formatter->asDecimal($model->monto), ['disabled' => true, 'class' => 'form-control text-bold', ]) ?>
                    </div>
                </div>
            </div>

            <?php if ($model->banco_id != 0) { ?>
            <div class="col-lg-12 mt-4">
                <div class="row">
                    <div class="col-lg-6">
                        <?= Html::label('Banco', 'banco_id', ['class' => 'lbl-view']) ?>
                        <?= Html::input('text', 'banco_id', $model->banco->bancoOperador->nombre_banco, ['disabled' => true, 'class' => 'form-control']) ?>
                    </div>                    
                    <div class="col-lg-6">
                        <?= Html::label('N° de Referencia', 'nro_referencia', ['class' => 'lbl-view']) ?>
                        <?= Html::input('text', 'nro_referencia', $model->nro_referencia, ['disabled' => true, 'class' => 'form-control', ]) ?>
                    </div>
                </div>
            </div>
            <?php } ?> 

            <div class="col-lg-12 mt-3">
                <div class="row mb-2">
                    <div class="col-lg-12">
                        <?= Html::label('Nota', 'nota', ['class' => 'lbl-view']) ?>
                        <div class="content-info-view"><?= $model->nota ?></div>
                    </div>
                </div>
            </div>                       

            <div align="right" class="col-lg-12 mt-4 mb-3">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
            </div>

        </div>
    </div>
</div>
