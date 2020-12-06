<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Cotizaciones */

$this->title = 'Reporte de Cotización';
$this->params['breadcrumbs'][] = ['label' => 'Cotizaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$fecha = date('d-m-Y', strtotime($model->fecha));

?>

<div class="cotizaciones-view">
    <div class="card card-primary">
        <div class="card-header">REPORTE DE COTIZACIÓN</div>
        <div class="card-body">    
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-6"><label class="lbl-view-title">Datos del CLiente</label></div>
                    <div align="right" class="col-lg-6">
                        <h5><span class="badge badge-primary">COTIZACIÓN N° : <?= $model->nro_documento ?></span></h5>
                    </div>
                </div><br>

                <div class="row">
                    <div class="col-lg-6">
                        <label class="lbl-view">Nombre del Cliente :  </label>
                        <div class="bt"><label class="lbl-view1"><?= $model->cliente->nombre ?></label></div>
                    </div>
                    <div class="col-lg-3">
                        <label class="lbl-view">N° de Identificación</label>
                        <div class="bt"><label class="lbl-view1"><?= $model->cliente->nro_identificacion ?></label></div>
                    </div> 
                </div>

                <div class="row mt-3 mb-4">
                    <div class="col-lg-6">
                        <label class="lbl-view">Dirección</label>
                        <div class="bt"><label class="lbl-view1"><?= $model->cliente->direccion ?></label></div>
                    </div>
                    <div class="col-lg-3">
                        <label class="lbl-view">Teléfono</label>
                        <div class="bt"><label class="lbl-view1"><?= $model->cliente->telefono ?></label></div>
                    </div>
                    <div class="col-lg-3">
                        <label class="lbl-view">Móvil</label>
                        <div class="bt"><label class="lbl-view1"><?= $model->cliente->movil ?></label></div>
                    </div>                                     
                </div>

                <div class="row mt-4">
                    <div class="col-lg-6 mt-4"><label class="lbl-view-title">Listado de Productos</label></div>
                    <div align="right" class="col-lg-6 mt-4">
                        <label class="lbl-view">FECHA : <?= $fecha ?></label>
                    </div>                    
                </div>                

                <hr>

                <div class="row mt-4">
                    <div class="col-lg-12 mt-3">
                        <table class="table table-bordered">
                            <thead align="center" class="thead-light">
                                <tr>
                                    <th scope="col"><label class="lbl-view">N°</label></th>
                                    <th scope="col"><label class="lbl-view">Descripción del Producto</label></th>
                                    <th scope="col"><label class="lbl-view">Cantidad</label></th>
                                    <th scope="col"><label class="lbl-view">Precio Unitario</label></th>
                                    <th scope="col"><label class="lbl-view">Importe</label></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                for ($i=0; $i < count($modelCP); $i++) { ?>
                                    <tr>
                                        <td style="padding: 8px 15px 3px 15px;" align="center" scope="row"><label class="lbl-view1"><b><?= $i+1 ?></b></label></td>

                                        <td style="padding: 8px 15px 3px 15px;"><label class="lbl-view1"><b><?= $modelCP[$i]->producto->nombre ?></b></label></td>

                                        <td style="padding: 8px 15px 3px 15px;" align="center"><label class="lbl-view1"><?= $modelCP[$i]->cantidad ?> <?= $modelCP[$i]->producto->medida->abv_med ?></label></td>

                                        <td style="padding: 8px 15px 3px 15px;" align="right"><label class="lbl-view1">$ <?= Yii::$app->formatter->asDecimal($modelCP[$i]->precio_unitario) ?></label></td>

                                        <td style="padding: 8px 15px 3px 15px;" align="right"><label class="lbl-view1">$ <?= Yii::$app->formatter->asDecimal($modelCP[$i]->precio) ?></label></td>
                                    </tr> 
                                <?php } ?>                                  
                            </tbody>

                            <tfooter>
                                <tr>
                                    <td colspan="3" style="vertical-align: middle;"><label class="lbl-view">N° de Documento : <?= $model->nro_documento ?></label></td>      

                                    <td style="padding: 13px 15px 0px 15px; border-top: 4px solid #ccc" align="right"><label class="lbl-view">Total</label></td>
                                
                                    <td style="padding: 13px 15px 0px 15px; border-top: 4px solid #ccc" align="right"><label class="lbl-view">$ <?= Yii::$app->formatter->asDecimal($model->precio_total) ?></label></td>
                                </tr>
                            </tfooter>                                                               
                        </table>
                    </div>
                </div> 

                <div class="row">
                    <div align="right" class="col-lg-12 mt-4 mb-3">
                        <?= Html::a('Nueva Cotización', ['cotizaciones/index'], ['class' => 'btn btn-success']) ?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <?= Html::a('Imprimir Cotización', [
                            '/cotizaciones/imprimir-pdf',
                            'id'=> $model->id,
                        ],   [
                            'class'=>'btn btn-primary', 
                            'target'=>'_blank', 
                            'data-toggle'=>'tooltip', 
                            'title'=>'Imprimir Comprobante'
                        ]) 
                        ?>
                    </div>
                </div>            

            </div>
        </div>
    </div>
</div>
