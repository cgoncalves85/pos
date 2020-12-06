<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OrdenCompra */

$this->title = 'Orden de Compra N° : '.$model->nro_documento;
$this->params['breadcrumbs'][] = ['label' => 'Orden Compras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$fecha = date('d-m-Y', strtotime($model->fecha));
$costo = (float)$costo_total;
$costo = number_format($costo, 2, '.', '');

?>
<div class="orden-compra-view">
    <div class="card card-primary">
        <div class="card-header">Información de Orden de Compra</div>
        <div class="card-body">    
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-6"><label>DATOS DEL PROVEEDOR</label></div>
                    <div align="right" class="col-lg-6">
                        <h5><span class="badge badge-primary">ORDEN DE COMPRA : <?= $model->nro_documento ?></span></h5>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-lg-6">
                        <label>Proveedor</label>
                        <input type="text" class="form-control" disabled value="<?= $model->proveedor->razon_social ?> (<?= $model->proveedor->nombre ?>)">
                    </div>
                    <div class="col-lg-3">
                        <label>NIF / CIF</label>
                        <input type="text" class="form-control" disabled value="<?= $model->proveedor->nif_cif ?>">
                    </div>                    
                </div>

                <div class="row mt-3 mb-4">
                    <div class="col-lg-6">
                        <label>Dirección</label>
                        <textarea class="form-control" disabled rows="2"><?= $model->proveedor->direccion ?></textarea>
                    </div>
                    <div class="col-lg-3">
                        <label>Teléfono</label>
                        <input type="text" class="form-control" disabled value="<?= $model->proveedor->telefono ?>">
                    </div>
                    <div class="col-lg-3">
                        <label>Móvil</label>
                        <input type="text" class="form-control" disabled value="<?= $model->proveedor->movil ?>">
                    </div>                                     
                </div>

                <div class="row mt-4">
                    <div class="col-lg-6 mt-4"><label>DATOS DE LA COMPRA</label></div>
                    <div align="right" class="col-lg-6 mt-4">
                        <h5><span class="badge badge-light">FECHA : <?= $fecha ?></span></h5>
                    </div>                    
                </div>                

                <hr>

                <div class="row mt-4">
                    <div class="col-lg-12 mt-3">
                        <table class="table table-responsive table-bordered table-striped">
                            <thead>
                                <tr align="center">
                                    <th style="width: 1%">N°</th>
                                    <th style="width: 25%">Descripción del Producto</th>
                                    <th style="width: 5%">Cant.</th>
                                    <th style="width: 5%">Precio</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for ($i=0; $i < count($modelOP) ; $i++) { ?>
                                <tr>
                                    <td align="center"><?= $i+1 ?></td>
                                    <td>
                                        <b><?= $modelOP[$i]->producto->categoria->categoria ?>
                                         - <?= $modelOP[$i]->producto->nombre ?></b>
                                    </td>
                                    <td align="center"><?= $modelOP[$i]->cantidad ?></td>
                                    <td align="right"><?= $modelOP[$i]->precio_compra ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>                            
                        </table>
                    </div>
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-10" align="right"><label>Costo Total : </label></div>
                            <div class="col-lg-2" align="right" style="padding-right: 23px"><b><?= $costo ?></b></div>
                        </div>
                    </div>
                </div> 

                <div class="row mt-4 mb-4">
                    <div class="col-lg-12 mb-4">
                        <?= Html::a( '<i class="fa fa-reply" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Regresar al Listado de Ordenes', ['index'], ['class' => 'btn btn-primary']); ?>
                    </div>
                </div>              

            </div>
        </div>
    </div>
</div>
