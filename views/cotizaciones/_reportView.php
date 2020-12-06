<?php
use yii\helpers\Html;

$fecha = date('d-m-Y', strtotime($model->fecha));
$identificacion = $model->cliente->tipo_identificacion.' - '.$model->cliente->nro_identificacion;

$nro = $model->nro_documento;
$nro_documento = str_pad($nro, 10, "0", STR_PAD_LEFT);

?>

<table border="0">
	<tr>
		<td align="center" width="20cm">
			<div class="lbl-nombre-tienda"><?= $tienda->razon_social.' - '.$tienda->nombre ?></div>
			<div class="lbl-direccion"><?= $tienda->direccion ?></div>
			<div class="lbl-direccion">Teléfonos : <?= $tienda->telefono.' / '.$tienda->movil ?></div>
			<div class="lbl-cif"><?= $tienda->nif_cif ?></div>
		</td>
	</tr>
</table>

<table style="margin-top: 10px;">
	<tr>
		<td align="center" class="border-nro" style="border: 0; font-size: 18px" width="20cm"><b>Cotización</b></td>
	</tr>
</table>

<table style="margin-top: 10px">
	<tr>
		<td class="border-nro" width="10cm" style="font-size: 14px"><b>Fecha : <?= $fecha ?></b></td>
		<td align="right" class="border-nro" width="10cm" style="font-size: 14px"><b>N° de Documento : <?= $nro_documento ?></b></td>
	</tr>
</table>

<table style="margin-top: 20px">
	<tr>
		<td class="lbl-dato-cliente lbl-view-title"><b>Datos del Cliente</b></td>
	</tr>
</table>

<table border="0">
	<tr>
		<td width="12cm" class="lbl-view">Nombre del Cliente : <b><?= $model->cliente->nombre ?></b></td>
		<td align="right" width="8cm" class="lbl-view">N° de Identificación : <b><?= $identificacion ?></b></td>
	</tr>	
</table>

<table border="0" style="margin-top: 8px">
	<tr>
		<td width="12cm" class="lbl-view" style="padding-top: 0px">Dirección : <b><?= $model->cliente->direccion ?></b></td>
		<td align="right" width="8cm" class="lbl-view" style="padding-top: 0px">Teléfonos : <b><?= $model->cliente->telefono ?> - <?= $model->cliente->movil ?></b></td>		
	</tr>	
</table>

<table style="margin-top: 20px">
	<tr>
		<td align="center" class="border-nro" style="border-bottom: 0" width="20cm"><b>Listado de Productos</b></td>
	</tr>
</table>

<table  class="tabla">
	<thead align="center">
		<tr>
			<th width="1cm" class="border">N°</label></th>
			<th width="9cm" class="border">Descripción del Producto</label></th>
			<th width="3cm" class="border">Cantidad</label></th>
			<th width="3.5cm" class="border">Precio Unitario</label></th>
			<th width="3.5cm" class="border">Importe</label></th>
		</tr>
	</thead>
	<tbody>
		<?php 
		for ($i=0; $i < count($productos); $i++) { ?>
			<tr>
				<td align="center" class="border"><b><?= $i+1 ?></b></td>
				<td class="border"><?= $productos[$i]->producto->nombre ?></td>
				<td align="center" class="border"><?= Yii::$app->formatter->asInteger($productos[$i]->cantidad) ?> <?= $productos[$i]->producto->medida->abv_med ?></td>
				<td align="right" class="border">$ <?= Yii::$app->formatter->asDecimal($productos[$i]->precio_unitario) ?></td>
				<td align="right" class="border">$ <?= Yii::$app->formatter->asDecimal($productos[$i]->precio) ?></td>
			</tr> 
		<?php } ?>                                  
	</tbody>

	<tfooter>
		<tr>
			<td class="border" colspan="3" style="vertical-align: middle;"><b>N° de Documento : <?= $nro_documento ?></b></td>			
			<td align="right" class="border" style="border-top: 3px solid #ccc"><b>Total</b></td>
			<td align="right" class="border" style="border-top: 3px solid #ccc"><b>$ <?= Yii::$app->formatter->asDecimal($model->precio_total) ?></b></td>
		</tr>
	</tfooter>                                                               
</table>




