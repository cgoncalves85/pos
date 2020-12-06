<?php

use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $model app\models\Ventas */

$this->title = 'Reporte de Venta';
$this->params['breadcrumbs'][] = ['label' => 'Ventas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$fecha = date('d-m-Y', strtotime($model->fecha));
$identificacion = $model->cliente->tipo_identificacion.' - '.$model->cliente->nro_identificacion;

$nro = $model->nro_documento;
$nro_documento = str_pad($nro, 10, "0", STR_PAD_LEFT);

?>
<div class="ventas-view">
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-primary" style="padding-bottom: 5px">
                <div class="card-header">REPORTE DE VENTA<span class="badge badge-light pl-2 pr-2" style="margin-top: 3px; float: right">FECHA : <?= $fecha ?></span></div>
                <div class="card-body"> 
                    <div class="row mt-2">
                        <div class="col-lg-6">           
                            <label class="lbl-view-title">Datos del Cliente</label>
                            <div class="form-group mt-3">
                                <div class="row">
                                    <div class="col-lg-7">
                                        <label class="lbl-view">Nombre del Cliente :  </label>
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="lbl-view">N° de Identificación :  </label>
                                    </div> 
                                    <div class="col-lg-1"></div>                                           
                                </div>

                                <div class="row">
                                    <div class="col-lg-7">
                                        <input type="text" class="form-control form-control-sm uppercase" value="<?= $model->cliente->nombre ?>" disabled>
                                    </div>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control form-control-sm uppercase" value="<?= $identificacion ?>" disabled>
                                    </div>
                                    <div class="col-lg-1"></div>
                                </div> 

                                <div class="row mt-4">
                                    <div class="col-lg-11">
                                        <label class="lbl-view">Dirección :  </label>
                                    </div> 
                                    <div class="col-lg-1"></div>                                          
                                </div>

                                <div class="row">
                                    <div class="col-lg-11">
                                        <textarea disabled="true" class="form-control form-control-sm"><?= $model->cliente->direccion ?></textarea>
                                    </div>
                                    <div class="col-lg-1"></div>
                                </div>  
                            </div>
                        </div>

                        <div class="col-lg-6">           
                            <label class="lbl-view-title">Datos del Vendedor</label>
                            <div class="form-group mt-3">
                                <div class="row">
                                    <div class="col-lg-7">
                                        <label class="lbl-view">Nombre del Vendedor :  </label>
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="lbl-view">Usuario :  </label>
                                    </div> 
                                    <div class="col-lg-1"></div>                                           
                                </div>

                                <div class="row">
                                    <div class="col-lg-7">
                                        <input type="text" class="form-control form-control-sm uppercase" value="<?= $model->user->nombre_completo ?>" disabled>
                                    </div>
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control form-control-sm uppercase" value="<?= $model->user->username ?>" disabled>
                                    </div>
                                    <div class="col-lg-1"></div>
                                </div> 

                                <div class="row mt-4">
                                    <div class="col-lg-11">
                                        <label class="lbl-view">Caja :  </label>
                                    </div> 
                                    <div class="col-lg-1"></div>                                          
                                </div>

                                <div class="row">
                                    <div class="col-lg-4">
                                        <input type="text" class="form-control form-control-sm uppercase" value="<?= $model->caja->descripcion ?>" disabled>
                                    </div>
                                </div>  
                            </div>                            
                        </div>

                        <div class="col-lg-12 mt-3 mb-3">
                            <hr>
                        </div>

                        <div class="col-lg-12">
                            <label class="lbl-view-title">Listado de Productos</label>
                        </div>                      

                        <div class="col-lg-12 mt-4 mb-4">
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
                                        for ($i=0; $i < count($productos); $i++) { 
                                        $porc_imp = ($productos[$i]->producto->impuesto->valor / 100) + 1;
                                        $precio = $productos[$i]->producto->precio / $porc_imp;
                                        $importe = $productos[$i]->cantidad * $precio;
                                        $importe = Yii::$app->formatter->asDecimal($importe);  
                                    ?>
                                    <tr>
                                        <td style="padding: 8px 15px 3px 15px;" align="center" scope="row"><label class="lbl-view1"><?= $i+1 ?></label></td>

                                        <td style="padding: 8px 15px 3px 15px;"><label class="lbl-view1"><?= $productos[$i]->producto->nombre ?></label></td>

                                        <td style="padding: 8px 15px 3px 15px;" align="center"><label class="lbl-view1"><?= $productos[$i]->cantidad ?> <?= $productos[$i]->producto->medida->abv_med ?></label></td>

                                        <td style="padding: 8px 15px 3px 15px;" align="right"><label class="lbl-view1">$ <?= Yii::$app->formatter->asDecimal($precio) ?></label></td>

                                        <td style="padding: 8px 15px 3px 15px;" align="right"><label class="lbl-view1">$ <?= $importe ?></label></td>
                                    </tr> 
                                    <?php } ?>                                  
                                </tbody>
                                <tfooter>
                                    <tr>
                                        <td rowspan="3" colspan="3" style="vertical-align: middle;"><label class="lbl-view">N° de Documento : <?= $nro_documento ?></label></td>

                                        <td style="padding: 8px 15px 3px 15px; border-top: 4px solid #ccc" align="right"><label class="lbl-view">Subtotal</label></td>
                                        <td style="padding: 8px 15px 3px 15px; border-top: 4px solid #ccc" align="right"><label class="lbl-view">$ <?= Yii::$app->formatter->asDecimal($model->subtotal) ?></label></td>
                                    </tr>
                                </tfooter>

                                <tfooter>
                                    <tr>
                                        
                                        <td style="padding: 8px 15px 3px 15px;" align="right"><label class="lbl-view1">Impuestos</label></td>
                                        <td style="padding: 8px 15px 3px 15px;" align="right"><label class="lbl-view1">$ <?= Yii::$app->formatter->asDecimal($model->impuesto) ?></label></td>
                                    </tr>
                                </tfooter> 

                                <tfooter>
                                    <tr>
                                       
                                        <td style="padding: 8px 15px 3px 15px;" align="right"><label class="lbl-view">Total</label></td>

                                        <td style="padding: 8px 15px 3px 15px;" align="right"><label class="lbl-view">$ <?= Yii::$app->formatter->asDecimal($model->total) ?></label></td>
                                    </tr>
                                </tfooter>                                                               
                            </table>
                        </div>

                        <div align="right" class="col-lg-12 mt-2 mb-3">
                            <?= Html::a('Nueva Venta', ['ventas/vender'], ['class' => 'btn btn-success']) ?>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <?= Html::a('Imprimir Documento', [
                                '/ventas/imprimir-pdf',
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

</div>
