<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\InventarioAuditoria */

$this->title = 'Reporte de Auditoria';
$this->params['breadcrumbs'][] = ['label' => 'Auditoria de Inventario', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$fecha = date('d-m-Y', strtotime($model->fecha));

?>
<div class="inventario-auditoria-view">
    <div class="card card-primary">
        <div class="card-header">Información de Auditoria de Inventario</div>
        <div class="card-body">    
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12"><label>DATOS DE LA AUDITORIA</label></div>
                </div>

                <hr class="line">

                <div class="row mt-4 mb-4">
                    <div class="col-lg-6">
                        <label>Descripción del Inventario</label>
                        <textarea class="form-control" disabled rows="1"><?= $model->descripcion ?></textarea>
                    </div>
                    <div class="col-lg-2">
                        <label>Fecha del Inventario</label>
                        <input type="text" class="form-control" disabled value="<?= $fecha ?>">
                    </div>                    
                </div>

                <div class="row mt-4">
                    <div class="col-lg-12 mt-4"><label>DATOS DE LA TIENDA</label></div>
                </div>

                <hr class="line">

                <div class="row">
                    <div class="col-lg-6">
                        <label>Tienda</label>
                        <input type="text" class="form-control" disabled value="<?= $model->tienda->nombre ?> - <?= $model->tienda->razon_social ?>">
                    </div>
                    <div class="col-lg-3">
                        <label>NIF / CIF</label>
                        <input type="text" class="form-control" disabled value="<?= $model->tienda->nif_cif ?>">
                    </div>                    
                </div>

                <div class="row mt-3 mb-4">
                    <div class="col-lg-6">
                        <label>Dirección</label>
                        <textarea class="form-control" disabled rows="2"><?= $model->tienda->direccion ?></textarea>
                    </div>
                    <div class="col-lg-3">
                        <label>Teléfono</label>
                        <input type="text" class="form-control" disabled value="<?= $model->tienda->telefono ?>">
                    </div>
                    <div class="col-lg-3">
                        <label>Móvil</label>
                        <input type="text" class="form-control" disabled value="<?= $model->tienda->movil ?>">
                    </div>                                     
                </div>

                <div class="row mt-4">
                    <div class="col-lg-12 mt-4"><label>LISTADO DE PRODUCTOS EN INVENTARIO</label></div>         
                </div>                

                <hr class="line">

                <div class="row mt-4">
                    <div class="col-lg-12 mt-3">
                        <table class="table table-responsive table-bordered table-striped">
                            <thead>
                                <tr align="center">
                                    <th style="width: 1%">N°</th>
                                    <th style="width: 25%">Descripción del Producto</th>
                                    <th style="width: 10%">Cant. Inicial</th>
                                    <th style="width: 10%">Cant. Final</th>
                                    <th style="width: 25%">Observación</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for ($i=0; $i < count($modelIAP) ; $i++) { ?>
                                <tr>
                                    <td align="center"><?= $i+1 ?></td>
                                    <td>
                                        <b><?= $modelIAP[$i]->producto->categoria->categoria ?>
                                         - <?= $modelIAP[$i]->producto->nombre ?></b>
                                    </td>
                                    <td align="right"><?= $modelIAP[$i]->cantidad ?></td>
                                    <td align="right"><?= $modelIAP[$i]->cantidad_final ?></td>
                                    <td align="right"><?= $modelIAP[$i]->observacion ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>                            
                        </table>
                    </div>
                </div> 

                <div class="row mt-4 mb-4">
                    <div align="right" class="col-lg-12 mt-2">
                        <?= Html::a( 'Regresar al Listado de Auditorias', ['index'], ['class' => 'btn btn-primary']); ?>
                    </div>
                </div>              

            </div>
        </div>
    </div>
</div>
