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

<table style="margin-top: 20px">
	<tr>
		<td class="border-nro" width="20cm">
			<b>Fecha : <?= $fecha ?></b>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<b>N° de Documento : <?= $nro_documento ?></b>
		</td>
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
		<td width="20cm" class="lbl-view" style="padding-top: 0px">Dirección : <b><?= $model->cliente->direccion ?></b></td>
	</tr>	
</table>

<table style="margin-top: 30px">
	<tr>
		<td class="lbl-dato-cliente lbl-view-title"><b>Datos del Vendedor</b></td>
	</tr>
</table>

<table border="0">
	<tr>
		<td width="12cm" class="lbl-view">Nombre del Vendedor : <b><?= $model->user->nombre_completo ?></b></td>
		<td align="right" width="8cm" class="lbl-view">ID del Vendedor : <b><?= $model->user->username ?></b></td>
	</tr>	
</table>

<table border="0" style="margin-top: 8px">
	<tr>
		<td width="20cm" class="lbl-view" style="padding-top: 0px">Caja : <b><?= $model->caja->descripcion ?></b></td>
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
		for ($i=0; $i < count($productos); $i++) { 
			$porc_imp = ($productos[$i]->producto->impuesto->valor / 100) + 1;
			$precio = $productos[$i]->producto->precio / $porc_imp;
			$importe = $productos[$i]->cantidad * $precio;
			$importe = Yii::$app->formatter->asDecimal($importe);    
			?>
			<tr>
				<td align="center" class="border"><b><?= $i+1 ?></b></td>
				<td class="border"><?= $productos[$i]->producto->nombre ?></td>
				<td align="center" class="border"><?= Yii::$app->formatter->asInteger($productos[$i]->cantidad) ?> <?= $productos[$i]->producto->medida->abv_med ?></td>
				<td align="right" class="border">$ <?= Yii::$app->formatter->asDecimal($precio) ?></td>
				<td align="right" class="border">$ <?= $importe ?></td>
			</tr> 
		<?php } ?>                                  
	</tbody>
	<tfooter>
		<tr>
			<td class="border" rowspan="3" colspan="3" style="vertical-align: middle;"><b>N° de Documento : <?= $nro_documento ?></b></td>
			<td align="right" class="border" style="border-top: 3px solid #ccc"><b>Subtotal</b></td>
			<td align="right" class="border" style="border-top: 3px solid #ccc"><b>$ <?= Yii::$app->formatter->asDecimal($model->subtotal) ?></b></td>
		</tr>
	</tfooter>

	<tfooter>
		<tr>
			<td align="right" class="border" style="border-bottom: 3px solid #ccc"><b>Impuestos</b></td>
			<td align="right" class="border" style="border-bottom: 3px solid #ccc"><b>$ <?= Yii::$app->formatter->asDecimal($model->impuesto) ?></b></td>
		</tr>
	</tfooter> 

	<tfooter>
		<tr>
			<td align="right" class="border" style="border-top: 3px solid #ccc"><b>Total</b></td>
			<td align="right" class="border" style="border-top: 3px solid #ccc"><b>$ <?= Yii::$app->formatter->asDecimal($model->total) ?></b></td>
		</tr>
	</tfooter>                                                               
</table>




