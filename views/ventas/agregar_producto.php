<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Existencias */
/* @var $form ActiveForm */

$precio = Yii::$app->formatter->asDecimal($producto->producto->precio);
$cantidad = intval($producto->cantidad);

?>
<div class="ventas-agregar_producto">
	<div class="row mt-1 mb-1 ml-1 mr-1">
		<div class="col-lg-12 mt-2 mb-3">
			<div class="row">
				<div class="col-lg-4 col-md-4 col">
					<label class="lbl-disponible"><?= $producto->producto->nombre ?></label>
					<input type="hidden" id="nombre_producto" value="<?= $producto->producto->nombre ?>">
					<input type="hidden" id="precio_producto" value="<?= $producto->producto->precio ?>">
					<input type="hidden" id="disponible" value="<?= $producto->cantidad ?>">
					<input type="hidden" id="impuesto" value="<?= $producto->producto->impuesto->valor ?>">
					<?= Html::img('@web/uploads/productos/'.$producto->producto->imagen, ['class' => 'img-fluid img-thumbnail']) ?>
				</div>
				<div class="col-lg-8 col-md-8 col">
					<div class="col-lg-12">
						<label>Precio : $ <?= $precio ?> / <?= $producto->producto->medida->abv_med ?></label>
					</div>					
					<div class="col-lg-12">
						<label>Disponible : <?= $cantidad ?> <?= $producto->producto->medida->abv_med ?></label>
					</div>
					<div class="col-lg-12">
						<label>Cantidad</label>
						<div class="row">
							<div class="col-lg-1 col">
								<a id="disminuir" class="btn btn-primary btn-sm btn-dis text-white"><</a>	
							</div>
							<div class="col-lg-3 col">
								<input readonly="true" type="text" class="form-control form-control-sm input-prod" style="text-align: center" id="cantidad" value="1">
							</div>
							<div class="col-lg-1 col" style="margin-left: -15px">
								<a id="aumentar" class="btn btn-primary btn-sm btn-aum text-white">></a>
							</div>

							<div align="right" class="col-lg-7 ml-2">
								<a id="add_producto" class="btn btn-primary btn-sm text-white">AGREGAR</a>
							</div>
					</div>

				</div>
			</div>														
		</div>
	</div>

</div><!-- ventas-agregar_producto -->

<?php   
	$this->registerJs(" 

		$('#aumentar').click(function() {
			valor = $('#cantidad').val();
			disponible = $('#disponible').val();
			disponible = parseInt(disponible);
			if (valor == disponible) {
				$('#cantidad').val(disponible);
			} else {
				nuevo_valor = parseInt(valor) + 1;
				$('#cantidad').val(nuevo_valor);
			}
		});
		$('#disminuir').click(function() {
			valor = $('#cantidad').val();
			if (valor == 1) {
				$('#cantidad').val(1);
			} else {	
				nuevo_valor = parseInt(valor) - 1;
				$('#cantidad').val(nuevo_valor);
			}
		});

		$('#add_producto').click(function() {
			disponible = $('#disponible').val();
			cantpro = $('#cant-productos').val();
			
			if (cantpro == 0) {
				$('#subtotal').val(0);
				$('#impuestos').val(0);
				$('#total').val(0);
			}

			nombre = $('#nombre_producto').val();
			precio = $('#precio_producto').val();
			valor_imp = $('#impuesto').val();
			dimp = (valor_imp/100)+1;
			precio_real = (precio/dimp);
			p = precio_real.toFixed(2)
			valor_impuesto = parseFloat(precio) - parseFloat(precio_real);
			
			cantidad = $('#cantidad').val();
			precio_producto = (parseFloat(precio_real) * parseInt(cantidad)).toFixed(2);
			precio_total = new Intl.NumberFormat().format(precio_producto);
			
			$('#lista-productos').append('<div class=row id=p'+cantpro+'><div class=col-lg-6><input type=text name=producto['+cantpro+'] readonly class=form-control value='+nombre+'></div><div class= col-lg-2><input id=ctd'+cantpro+' type=text name=cantidad['+cantpro+'] readonly class=form-control value='+cantidad+'></div><div class= col-lg-4><input id=precio'+cantpro+' type=text name=precio['+cantpro+'] readonly class=form-control value='+precio_total+'><input id=precio2'+cantpro+' type=text class=d-none value='+precio_producto+'><input id=precioreal'+cantpro+' type=text class=d-none value='+p+'><input id=imp'+cantpro+' type=text class=d-none value='+valor_impuesto+'><input id=dispo'+cantpro+' type=text class=d-none value='+disponible+'></div><br><div class=col-lg-12><a class=btn id=menos'+cantpro+'></a>&nbsp;&nbsp;&nbsp;<a class=btn id=mas'+cantpro+'></a><a class=btn id=remover'+cantpro+'></a></div></div>');

			$('#ctd'+cantpro).addClass('text-center');
			$('#precio'+cantpro).addClass('text-right');

			$('#menos'+cantpro).html('<i class=fa id=min'+cantpro+' aria-hidden=true></i>');
			$('#min'+cantpro).addClass('fa-chevron-down');
			$('#min'+cantpro).addClass('text-white');

			$('#mas'+cantpro).html('<i class=fa id=more'+cantpro+' aria-hidden=true></i>');
			$('#more'+cantpro).addClass('fa-chevron-up');
			$('#more'+cantpro).addClass('text-white');

			$('#remover'+cantpro).html('<i class=fa id=quitar'+cantpro+' aria-hidden=true></i>&nbsp;&nbsp;Eliminar');
			$('#quitar'+cantpro).addClass('fa-times-circle');
			$('#quitar'+cantpro).addClass('text-white');

			$('#menos'+cantpro).addClass('btn-danger btn-sm mt-3 mb-3 fs7');
			$('#mas'+cantpro).addClass('btn-primary btn-sm mt-3 mb-3 fs7');
			$('#remover'+cantpro).addClass('btn-danger btn-sm mt-3 mb-3 float-right fs7 text-white');

			$('#remover'+cantpro).click(function() { 
				id_remover = $(this).attr('id');
				s = id_remover.substr(7);
				
				precio = $('#precio2'+s).val();
				total_impuesto = $('#impuestos').val();

				total = $('#subtotal').val();
				total_neto = parseFloat(total) - parseFloat(precio);
				total_neto2 = new Intl.NumberFormat().format(total_neto);

				if (total_neto2 == 0) {
					total_neto2 = '';
					$('#detalles_descuento').css('display','none');
				}

				$('#subtotal').val(total_neto);
				$('#st').val(total_neto2);

				cantidad_producto = $('#ctd'+s).val();
				valorimp = $('#imp'+s).val();
				valorimp = valorimp * cantidad_producto;
				

				impuesto_total = (parseFloat(total_impuesto) - parseFloat(valorimp)).toFixed(2); 
				impuesto_total2 = new Intl.NumberFormat().format(impuesto_total);	

				if (impuesto_total2 == 0) {
					impuesto_total2 = '';
				}

				$('#impuestos').val(impuesto_total);
				$('#imp').val(impuesto_total2);

				total_pago = (parseFloat(total_neto) + parseFloat(impuesto_total)).toFixed(2);
				total_pago2 = new Intl.NumberFormat().format(total_pago);

				if (total_pago2 == 0) {
					total_pago2 = '';
				}				

				$('#total').val(total_pago);
				$('#tot').val(total_pago2);				

				$('#p'+s).remove();
				
				cantpro = cantpro -1;
				$('#cant-productos').val(cantpro);
			});	

			$('#menos'+cantpro).click(function() {
				id_menos = $(this).attr('id');
				id_menos = id_menos.substr(5);
				cantidad_actual = $('#ctd'+id_menos).val();
				precior = ($('#precioreal'+id_menos).val());	

				if (cantidad_actual == 1) {
					$('#ctd'+id_menos).val(1);
				} else {
					cantidad_nueva = parseInt(cantidad_actual) - 1;
					$('#ctd'+id_menos).val(cantidad_nueva);

					precio_producto = parseFloat(precior) * parseInt(cantidad_nueva);
					precio_total = new Intl.NumberFormat().format(precio_producto);
					$('#precio'+id_menos).val(precio_total);
					$('#precio2'+id_menos).val(precio_producto);

					valorimp = $('#imp'+id_menos).val();
					
					subtotal = $('#subtotal').val();
					total_impuesto = $('#impuestos').val();

					total_neto = parseFloat(subtotal) - parseFloat(precior);
					total_neto2 = new Intl.NumberFormat().format(total_neto);

					$('#subtotal').val(total_neto);
					$('#st').val(total_neto2);

					impuesto_total = (parseFloat(total_impuesto) - parseFloat(valorimp)).toFixed(2); 
					impuesto_total2 = new Intl.NumberFormat().format(impuesto_total);			

					$('#impuestos').val(impuesto_total);
					$('#imp').val(impuesto_total2);

					total_pago = parseFloat($('#subtotal').val()) + parseFloat($('#impuestos').val());
					total_pago2 = new Intl.NumberFormat().format(total_pago);

					$('#total').val(total_pago);
					$('#tot').val(total_pago2);	
				}
				$('#app_discount').trigger('click');			
			});	

			$('#mas'+cantpro).click(function() {
				id_mas = $(this).attr('id');
				id_mas = id_mas.substr(3);

				cantidad_actual = $('#ctd'+id_mas).val();
				precior = ($('#precioreal'+id_mas).val());	


				disposicion = parseInt($('#dispo'+id_mas).val());

				if (cantidad_actual == disposicion) {
					$('#ctd'+id_mas).val(disposicion);

					precio_producto = parseFloat(precior) * parseInt(disposicion);
					precio_total = new Intl.NumberFormat().format(precio_producto);
					$('#precio'+id_mas).val(precio_total);
					$('#precio2'+id_mas).val(precio_producto);


				} else {
					cantidad_nueva = parseInt(cantidad_actual) + 1;
					$('#ctd'+id_mas).val(cantidad_nueva);


					precio_producto = parseFloat(precior) * parseInt(cantidad_nueva);
					precio_total = new Intl.NumberFormat().format(precio_producto);
					$('#precio'+id_mas).val(precio_total);
					$('#precio2'+id_mas).val(precio_producto);

					valorimp = $('#imp'+id_mas).val();
					
					subtotal = $('#subtotal').val();
					total_impuesto = $('#impuestos').val();

					total_neto = parseFloat(subtotal) + parseFloat(precior);
					total_neto2 = new Intl.NumberFormat().format(total_neto);

					$('#subtotal').val(total_neto);
					$('#st').val(total_neto2);

					impuesto_total = (parseFloat(total_impuesto) + parseFloat(valorimp)).toFixed(2); 
					impuesto_total2 = new Intl.NumberFormat().format(impuesto_total);			

					$('#impuestos').val(impuesto_total);
					$('#imp').val(impuesto_total2);

					total_pago = parseFloat($('#subtotal').val()) + parseFloat($('#impuestos').val());
					total_pago2 = new Intl.NumberFormat().format(total_pago);

					$('#total').val(total_pago);
					$('#tot').val(total_pago2);
				}
				$('#app_discount').trigger('click');
			});					

			precio = $('#precio'+cantpro).val();
			valorimp = $('#imp'+cantpro).val();
			total = $('#total').val();
			total_impuesto = $('#impuestos').val();

			total_neto = parseFloat(total) + (parseFloat(precio_producto) - parseFloat(total_impuesto));
			total_neto2 = new Intl.NumberFormat().format(total_neto);

			$('#subtotal').val(total_neto);
			$('#st').val(total_neto2);

			cantidad_producto = $('#ctd'+cantpro).val();
			valorimp = valorimp * cantidad_producto;

			impuesto_total = (parseFloat(total_impuesto) + parseFloat(valorimp)).toFixed(2); 
			impuesto_total2 = new Intl.NumberFormat().format(impuesto_total);			

			$('#impuestos').val(impuesto_total);
			$('#imp').val(impuesto_total2);

			total_pago = parseFloat($('#subtotal').val()) + parseFloat($('#impuestos').val());
			total_pago2 = new Intl.NumberFormat().format(total_pago);

			$('#total').val(total_pago);
			$('#tot').val(total_pago2);

			cantpro = parseInt(cantpro) + 1;
			$('#cant-productos').val(cantpro);					

			$('#agregar_producto').modal('hide');

			$('#app_discount').trigger('click');

		});

    ");
?>