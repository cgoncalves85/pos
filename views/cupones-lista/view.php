<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CuponesLista */

if($model->status == 0) {
    $estado = '<span class="badge badge-danger">LISTA DE CUPONES INACTIVA</span>';
} elseif ($model->status == 1) {
    $estado = '<span class="badge badge-success">LISTA DE CUPONES ACTIVA</span>';
}

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cupones Listas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="cupones-lista-view">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-6">
                <?= Html::label('Descripción', 'descripcion', ['class' => 'lbl-view']) ?>
                <?= Html::input('text', 'descripcion', $model->descripcion, ['disabled' => true, 'class' => 'form-control']) ?>
            </div>

            <div class="col-lg-2">
                <?= Html::label('N° de Cupones', 'cantidad_cupones', ['class' => 'lbl-view']) ?>
                <?= Html::input('text', 'cantidad_cupones', $model->cantidad_cupones, ['disabled' => true, 'class' => 'form-control']) ?>
            </div>
            <div class="col-lg-4">
                <?= Html::label('Estado', 'status', ['class' => 'lbl-view mr-1']) ?>
                <div><?= $estado ?></div>
            </div>
        </div>

        <div class="row mt-4"> 
            <div class="col-lg-4">
                <?= Html::label('Fecha de Inicio', 'fecha_inicio', ['class' => 'lbl-view']) ?>
                <?= Html::input('text', 'fecha_inicio', date('d-m-Y', strtotime($model->fecha_inicio)), ['disabled' => true, 'class' => 'form-control']) ?>
            </div>

            <div class="col-lg-4">
                <?= Html::label('Fecha de Caducidad', 'fecha_fin', ['class' => 'lbl-view']) ?>
                <?= Html::input('text', 'fecha_fin', date('d-m-Y', strtotime($model->fecha_fin)), ['disabled' => true, 'class' => 'form-control']) ?>
            </div>
        </div>

        <div class="row mt-4 mb-2"><div class="col-lg-12"><hr class="line"></div></div>

        <div class="row mb-4">
            <div class="col-lg-12">
                <label class="lbl-view">Listado de Cupones Disponibles</label><span class="badge badge-info ml-4"><?= count($disponibles) ?></span>
            </div>
            <div class="col-lg-12">
                <?php if (count($disponibles) > 0) { ?>
                    <table class="table table-fluid table-striped table-cupones">
                        <thead align="center">
                            <th>N°</th>
                            <th>CUPÓN</th>
                            <th>DESCUENTO</th>
                        </thead>
                        <tbody>
                            <?php for ($i=0; $i < count($disponibles) ; $i++) { ?>
                                <tr align="center">
                                    <td><b><?= $i+1 ?></b></td>
                                    <td><div class="content-cupon"><?= $disponibles[$i]->cupon ?></div></td>
                                    <td><?= $disponibles[$i]->porcentaje_descuento.' %' ?></td>
                                </tr>
                            <?php } ?>                                              
                        </tbody>
                    </table>
                <?php } else { ?>
                    <div class="mt-4" align="center">
                        <span class="badge badge-danger">NO EXISTEN CUPONES DISPONIBLES</span>
                    </div>
                <?php } ?>                    
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-lg-12">
                <label class="lbl-view">Listado de Cupones ya Utilizados</label><span class="badge badge-info ml-4"><?= count($usados) ?></span>
            </div>
            <div class="col-lg-12">
                <?php if (count($usados) > 0) { ?>
                    <table class="table table-fluid table-striped table-cupones">
                        <thead align="center">
                            <th>N°</th>
                            <th>CUPÓN</th>
                            <th>DESCUENTO</th>
                        </thead>
                        <tbody>
                            <?php for ($i=0; $i < count($usados) ; $i++) { ?>
                                <tr align="center">
                                    <td><b><?= $i+1 ?></b></td>
                                    <td><div class="content-cupon bg-red"><?= $usados[$i]->cupon ?></div></td>
                                    <td><?= $usados[$i]->porcentaje_descuento.' %' ?></td>
                                </tr>
                            <?php } ?>                                              
                        </tbody>
                    </table>
                <?php } else { ?>
                    <div class="mt-4" align="center">
                        <span class="badge badge-danger">NO EXISTEN CUPONES YA UTILIZADOS</span>
                    </div>
                <?php } ?>
            </div>
        </div>                                                 
    </div>
</div>
