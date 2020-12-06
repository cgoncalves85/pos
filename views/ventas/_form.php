<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Modal;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Ventas */
/* @var $form yii\widgets\ActiveForm */

Modal::begin([
  'title' => '<span class= lbl-modal>Agregar Producto</span>',
  'id' => 'agregar_producto',
  'size' => 'modal-md',

]);

echo "<div id='modalContent'></div>";

Modal::end();

Modal::begin([
  'title' => '<span class= lbl-modal>Agregar Cliente</span>',
  'id' => 'crear-cliente',
  'size' => 'modal-lg',

]);

echo "<div id='modalContent'></div>";

Modal::end();

Modal::begin([
  'title' => '<span class= lbl-modal>Listado de Bonos por Puntos Acumulados</span>',
  'id' => 'ver-bonos',
  'size' => 'modal-lg',

]);

echo "<div id='modalBonos'></div>";

Modal::end();

?>

<div class="ventas-form">
	<div class="row">
		<div class="col-lg-8">
			<div class="card card-primary" style="padding-bottom: 5px">
				<div class="card-body">
					<div class="col-lg-12">					
						<div class="row" style="padding-top: 10px">
							<div class="col-lg-3">
								<label class="lbl-search">Buscar Productos</label>
							</div>

							<div class="col-lg-9">
								<input type="text" class="form-control" id="busqueda">								
								<input type="text" style="display: none" class="form-control" id="busqueda_categoria">	
							</div>
						</div>

				    	<div class="row mt-2">
				    		<div class="col-lg-12">
				    			<hr>
				    			<label class="lbl-search">Categorias</label>
				    		</div>
				    		<div class="col-lg-12">
				    			<div class="row">
				    				<?php foreach ($categorias as $cat) { ?>				    					
				    				<div class="col-xl-3 col-lg-4 col-md-4 col-sm-4" id="items">
				    					<div class="cat-selector" id="<?= $cat->id ?>">
											<?= Html::img('@web/uploads/categorias/'.$cat->imagen, ['class' => 'img img-fluid img-cat']) ?>
										</div>
										<label class="lbl-cat"><?= $cat->categoria ?></label>
				    				</div>
				    				<?php } ?>
				    			</div>
				    		</div>
				    	</div>

				    	<div class="row mt-2">
				    		<div class="col-lg-12">
				    			<hr>
				    			<label class="lbl-search">Productos</label>
				    		</div>
				    		<div class="col-lg-12">
				    			<div class="row">
				    				<?php 
				    				foreach ($productos as $prod) { ?>			    					
				    					<div id="nombre_producto" class="col-xl-3 col-lg-4 col-md-4 col-sm-4">
				    						<div class="blog-inner">
				    						<div class="prod-selector">
				    							<?= Html::img('@web/uploads/productos/'.$prod->producto->imagen, ['class' => 'img img-fluid img-cat']) ?>
				    							<?= Html::a('<i class="fa fa-plus-circle" aria-hidden="true"></i>', '#', [
				    								'class' => 'btn btn-primary btn-sm btn-producto',
				    								'id' => 'BtnModal',
				    								'data-toggle' => 'modal',
				    								'data-target' => '#agregar_producto',
				    								'data-url' => Url::to(['agregar', 'id' => $prod->producto->id]),
				    								'data-pjax' => '0',
				    							])?>												
				    						</div>
				    						<label class="lbl-cat" style="display: none"><?= $prod->producto->categoria_id ?></label>
				    						<label class="lbl-cat"><?= $prod->producto->nombre ?></label>
				    						</div>
				    					</div>
				    				<?php } ?>
				    			</div>
				    		</div>
				    	</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-lg-4">
			<div class="card card-primary">
				<div class="card-body" id="mycard">
				    <?php $form = ActiveForm::begin(); ?>
				    <div class="col-lg-12">
				    	<div class="row">
				    		<div class="col-lg-10">
		                        <?= $form->field($model, 'cliente_id')->widget(Select2::classname(), [
		                            'data' => $clientes,
		                            'options' => [
		                            	'id' => 'id_cliente',
		                            	'placeholder' => 'Seleccione Cliente',
		                            	'onchange' => 'buscarCredito();',
		                            ],
		                            'pluginOptions' => [
		                              'allowClear' => true
		                            ],
		                        ]) ?>
				    		</div>

				    		<div class="col-lg-1" style="margin-top: 36px">
						        <?= Html::button('<i class="fa fa-plus-circle" aria-hidden="true"></i>', [ 
						        	'value' => Yii::$app->urlManager->createUrl('/clientes/create'),
						            'class' => 'btn btn-primary btn-sm',
						            'id' => 'BtnCliente',
						            'data-toggle'=> 'modal',
						            'data-target'=> '#crear-cliente',
						          ]) ?>
				    		</div>
				    	</div>

				    	<div class="row">
				    		<div class="col-lg-6">
				    			<label class="badge badge-light pl-0" style="margin-top: 8px">Puntos Acumulados</label>
				    		</div>
				    		<div id="content-puntos" class="col-lg-4">
						        <?= Html::button('0', [  
						        	'value' => Url::to(['bonos', 'id' => 0]),        
						            'class' => 'badge badge-primary px-4 pl-2 pr-4 pt-2 pb-2',
						            'style' => ['cursor' => 'pointer', 'border-color' => 'transparent', 'width' => '100%'],
						            'title' => 'Bonos por Puntos Acumulados',
						            'id' => 'puntos',
						            'data-toggle'=> 'modal',
						            'data-target'=> '#ver-bonos',
						            //'data-url' => Url::to(['bonos', 'id' => 0]),
						        ]) ?>
				    		</div>
				    		<div class="col-lg-2">
				    			<span class="x-small d-inline-block" style="margin-left: -5px; margin-top: 10px">Ptos.</span>
				    		</div>
				    		<div class="col-lg-12">
				    			<div id="bonos-aplicados"></div>
				    		</div>				    		
				    	</div>

				    	<div class="row mt-4">
				    		<div class="col-lg-9">
				    			<label style="margin-top: 8px">Cantidad de Productos</label>
				    		</div>
				    		<div class="col-lg-3">
				    			<input readonly="true" style="text-align: center; font-weight: bold" class="form-control" type="text" name="cant-productos" id="cant-productos" value="0">
				    		</div>				    		
				    	</div>				    	

				    	<div class="row">
				    		<div class="col-lg-12">
				    			<hr>
				    		</div>
				    	</div>

				    	<div class="row">
				    		<div class="col-lg-6">
				    			<label>Producto</label>
				    		</div>
				    		<div class="col-lg-3">
				    			<label>Cant</label>
				    		</div>
				    		<div class="col-lg-3">
				    			<label>Precio</label>
				    		</div>				    						    		
				    	</div>

				    	<div class="row">
				    		<div class="col-lg-12">
				    			<hr>
				    		</div>
				    	</div>

				    	<div id="lista-productos"></div>	

				    	<div class="row" style="margin-top: -15px">
				    		<div class="col-lg-12">
				    			<hr>
				    		</div>
				    	</div>			    	

					    <div class="row mt-4">
					    	<div class="col-lg-5">
					    		<label class="lbl-create-venta">SUBTOTAL : </label>
					    	</div>					    	
					    	<div class="col-lg-7">	
								<div class="input-group">
								  <div class="input-group-prepend">
								    <span class="input-group-text"><b>$</b></span>
								  </div>
								  <input type="text" id="st" class="form-control text-right font-weight-bold" placeholder="0.00" readonly>
								</div>
					    		<?= $form->field($model, 'subtotal')->textInput(['id' => 'subtotal', 'maxlength' => true, 'class' => 'form-control text-right d-none', 'placeholder' => '0.00', 'readonly' => true])->label(false) ?>
					    	</div>

					    	<div class="col-lg-5">
					    		<label class="lbl-create-venta">IMPUESTOS : </label>
					    	</div>
					    	<div class="col-lg-7" style="text-align: right">
								<div class="input-group">
								  <div class="input-group-prepend">
								    <span class="input-group-text"><b>$</b></span>
								  </div>
								  <input type="text" id="imp" class="form-control text-right font-weight-bold" placeholder="0.00" readonly>
								</div>					    		
					    		<?= $form->field($model, 'impuesto')->textInput(['id' => 'impuestos', 'maxlength' => true, 'class' => 'form-control text-right d-none', 'placeholder' => '0.00', 'readonly' => true])->label(false) ?>
					    	</div>

					    	<div class="col-lg-5">
					    		<label class="lbl-create-venta">TOTAL A PAGAR : </label>
					    	</div>
					    	<div class="col-lg-7">
								<div class="input-group">
								  <div class="input-group-prepend">
								    <span class="input-group-text"><b>$</b></span>
								  </div>
								  <input type="text" id="tot" class="form-control text-right font-weight-bold" placeholder="0.00" readonly>
								</div>					    		
					    		<?= $form->field($model, 'total')->textInput(['id' => 'total', 'maxlength' => true, 'class' => 'form-control text-right d-none', 'placeholder' => '0.00', 'readonly' => true, 'style' => ['font-weight' => 'bold']])->label(false) ?>
					    	</div>

					    	<div id="app_descuento" style="display: none" class="col-lg-12 mt-2">
					    		<hr>
					    		<div align="right" class="form-group">
					    			<a id="app_discount" style="display: none" onclick="aplicarDescuento();" class="btn btn-primary text-white"><b>APLICAR DESCUENTO</b></a>
					    		</div>
					    		<div id="detalles_descuento" style="display: none">
					    			<div class="row" style="margin-top: 35px">
								    	<div class="col-lg-5">
								    		<label class="lbl-create-venta">DESCUENTO : </label>
								    	</div>
								    	<div class="col-lg-7">
											<div class="input-group">
											  <div class="input-group-prepend">
											    <span class="input-group-text"><b>$</b></span>
											  </div>
											  <input type="text" id="descuento1" class="form-control text-right font-weight-bold" placeholder="0.00" readonly>
											</div>					    		
								    		<?= $form->field($model, 'valor_descuento')->textInput(['id' => 'valor_descuento', 'maxlength' => true, 'class' => 'form-control text-right d-none', 'placeholder' => '0.00', 'readonly' => true, 'style' => ['font-weight' => 'bold']])->label(false) ?>
								    	</div>
								    </div>
								    <div class="row">
								    	<div class="col-lg-5">
								    		<label class="lbl-create-venta">TOTAL A PAGAR : </label>
								    	</div>
								    	<div class="col-lg-7">
											<div class="input-group">
											  <div class="input-group-prepend">
											    <span class="input-group-text"><b>$</b></span>
											  </div>
											  <input type="text" id="total_pay2" class="form-control text-right font-weight-bold" placeholder="0.00" readonly>
											</div>					    		
								    		<?= $form->field($model, 'total_pay')->textInput(['id' => 'total_pay', 'maxlength' => true, 'class' => 'form-control text-right d-none', 'placeholder' => '0.00', 'readonly' => true, 'style' => ['font-weight' => 'bold']])->label(false) ?>
								    	</div>
								    </div>	
					    		</div>
					    	</div>					    	

					    	<div class="col-lg-12 mt-2">
					    		<hr>
		                        <?= $form->field($model, 'forma_pago_id')->widget(Select2::classname(), [
		                            'data' => $metodos_pago,
		                            'options' => [
		                            	'id' => 'id_forma_pago',
		                            	'placeholder' => 'Seleccione Forma de Pago',
		                            	'onchange' => 'validarMontos();',
		                            ],
		                            'pluginOptions' => [
		                              'allowClear' => true,
		                              'disabled' => true
		                            ],
		                        ]) ?>					    		
					    	</div>

					    	<div class="col-lg-12 mt-4">
						    	<div align="right" class="form-group">
						        	<?= Html::submitButton('<b>PROCESAR VENTA</b>', ['class' => 'btn btn-primary btn-block']) ?>
						    	</div>
						    </div>
						</div>
					</div>
				    <?php ActiveForm::end(); ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php   
	$this->registerJs(" 
	    $('#BtnCliente').click(function(e) {    
	    	e.preventDefault();
	      	$('#crear-cliente').modal('show')
	      	.find('#modalContent')
	      	.load($(this).attr('value'));
	      	return false;
	    });

		$(document).ready(function() {
			$('#busqueda').on('keyup', function() {
		    	value = $(this).val().toLowerCase();
		    	$('#nombre_producto .blog-inner').filter(function() {
		      		$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		    	});
		  	});

			$('#busqueda_categoria').on('change', function() {
		    	value = $(this).val().toLowerCase();
		    	$('#nombre_producto .blog-inner').filter(function() {
		      		$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		    	});
		  	});	

		});

    	$(document).on('click', '#BtnModal', (function() {
      		$.get(
        		$(this).data('url'),
        		function (data) {
          			$('#modalContent').html(data);
          			$('#agregar_producto').modal();
        		}
      		);
    	}));  	

		$('#producto_id').change(function() {
			$('#categoria_id').val('');
			$('#search-btn').click();
		});

		$('#items div').click(function() {
			$('#producto_id').val('');
			id = $(this).attr('id')
			$('#busqueda_categoria').val(id);
			$('#busqueda_categoria').trigger('change');			
		});	

		$('#id_cliente').change(function() {
			$('#id_forma_pago').prop('disabled', false);
		});	

	    $('#puntos').click(function(e) {    
	    	e.preventDefault();
	      	$('#ver-bonos').modal('show')
	      	.find('#modalBonos')
	      	.load($(this).attr('value'));
	      	return false;
	    });
    ");
?>

<link rel="stylesheet" type="text/css" href="../vendor/bower-asset/sweetalert/dist/sweetalert.css">
<script src="../vendor/bower-asset/sweetalert/dist/sweetalert.min.js"></script>

<script>
	function buscarCredito() {
		id_cliente = $("#id_cliente").val()
		if (id_cliente == '') {
			$('#id_forma_pago option[value="3"]').remove();
		}
		$.ajax({
			url: '<?php echo \Yii::$app->getUrlManager()->createUrl('ventas/creditos') ?>',
			type: 'post',
			data: { 
				id: id_cliente
			},
			success: function (data) {
				monto = data.datos['monto'];
				mensaje = data.datos['mensaje'];
				puntos = data.datos['puntos'];
				$('#remover_bono').trigger('click');
				$('#puntos_new').hide();
				$('#puntos').show();
				$('#puntos').html(puntos);
				$('#puntos').val('/pos/web/index.php?r=ventas%2Fbonos&id='+puntos);
				if (monto != 0) {
					$('#id_forma_pago').append("<option value='3' >Crédito</option>");
					swal(mensaje, "$ "+monto, "success");
				} else {
					
					$('#id_forma_pago option[value="3"]').remove();
				}
			},           
		});
	}

	function aplicarBono(id) {
		$.ajax({
			url: '<?php echo \Yii::$app->getUrlManager()->createUrl('bonos/aplicar-bono') ?>',
			type: 'post',
			data: { 
				id: id
			},
			success: function (data) {
				puntos = data.datos['puntos'];
				descripcion = data.datos['descripcion'];
				tipo_bono = data.datos['tipo_bono'];
				bono = data.datos['bono'];
				if (tipo_bono == 1) {
					$('#bonos-aplicados').append('<div id="bono_aplicado"><label class="mt-4">Descripción del Bono</label><input class="form-control mb-2 lbl-view" disabled value = "Descuento del '+ parseInt(bono)+'%"><div class="row"><div class = "col-lg-12" align="right"><a id="remover_bono" onclick="removerBono();" class="btn btn-danger btn-sm float-right fs7 text-white"><i class="fa fa-times-circle" aria-hidden="true"></i>&nbsp;&nbsp;ELIMINAR</a></div></div></div>');
						$('#app_descuento').show();
						$('#app_discount').trigger('click');
				}
				if (tipo_bono == 2) {
					$('#bonos-aplicados').append('<div id="bono_aplicado"><label class="mt-4">Descripción del Bono</label><input class="form-control mb-2 lbl-view" disabled value = "Premio de '+bono+'"><div class="row"><div class = "col-lg-12" align="right"><a onclick="removerBono();" class="btn btn-danger btn-sm float-right fs7 text-white"><i class="fa fa-times-circle" aria-hidden="true"></i>&nbsp;&nbsp;ELIMINAR</a></div></div></div>');
				}
				cant_puntos = $('#puntos').html() - puntos;
				$('#puntos').hide();				
				$('#content-puntos').append('<div id="puntos_new" class="badge badge-primary lbl-points">'+cant_puntos+'</div>');
				$('#ver-bonos').modal('hide');
			},           
		});
	}

	function removerBono() {
	    $('#bono_aplicado').remove();
	   	puntos_acum = parseInt($('#content-puntos div').html());
	   	cant_puntos = parseInt(puntos_acum) + parseInt(puntos);
		$('#puntos_new').remove(); 
		$('#puntos').html(cant_puntos);	
		$('#puntos').val('/pos/web/index.php?r=ventas%2Fbonos&id='+cant_puntos);
		$('#puntos').show();
		bono = 0;
		$('#app_discount').trigger('click');	
		$('#app_descuento').hide();
	}

	function aplicarDescuento() {	
		total  = $('#total').val();	
		porcent = (total * parseInt(bono))/100;
		total_pay = (parseFloat(total) - parseFloat(porcent)).toFixed(2);
		total_pay2 = new Intl.NumberFormat().format(total_pay);
		descuento = new Intl.NumberFormat().format(porcent);

		if (porcent == 0) {total_pay2=0}
		if (total_pay2 == 0) {
			total_pay2 = '';
			porcent = '';
		}					

		$('#descuento1').val(porcent);	
		$('#valor_descuento').val(descuento);			
		$('#total_pay').val(total_pay);
		$('#total_pay2').val(total_pay2);
		$('#detalles_descuento').show();	
	}

	function validarMontos() {
	  swal({
	    title: "Verificando Montos",
	    text: "Procesando...",
	    timer: 4000,
	    showConfirmButton: false
	  });
	}	

</script>