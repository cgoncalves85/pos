<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap4\Modal;

Modal::begin([
  'title' => 'REPORTE DE GASTOS',
  'id' => 'form_gastos',
  'size' => 'modal-md',
  'bodyOptions' => ['style' => 'top: 0px; padding:20px'],

]);

echo "<div id='modalContenedor'></div>";

Modal::end();

$this->title = 'Reportes';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-reportes">
	<div class="card card-primary">
        <div class="card-header">Listado de Reportes</div>
        <div class="card-body">
        	<div class="row mt-4">
        		<div class="col-lg-4">
        			<div class="title-report">
        				<i class="fas fa-shopping-basket icons-report"></i>
        				Ventas
        			</div>
        			<div class="list-reportes">
        				<ul>
        					<li><?= Html::a('Ventas', ['reportes/rpt-ventas'], ['class' => 'reportes-link']) ?></li>
        					<li><?= Html::a('Ventas por Categoria', ['reportes/rpt-ventas-categoria'], ['class' => 'reportes-link']) ?></li>
       						<li><?= Html::a('Ventas por Forma de Pago', ['reportes/rpt-ventas-pago'], ['class' => 'reportes-link']) ?></li>
       						<li><?= Html::a('Informe Total de Ventas por Atributo', ['reportes/rpt-ventas-atributo'], ['class' => 'reportes-link']) ?></li>
       						<li><?= Html::a('Productos Vendidos por Cliente', ['reportes/rpt-productos-cliente'], ['class' => 'reportes-link']) ?></li>
       						<li>Puntos Acumulados por Cliente</li>
       						<li><?= Html::a('Detalles de Ventas por Vendedor', ['reportes/rpt-ventas-vendedor'], ['class' => 'reportes-link']) ?></li>
       					</ul>
       				</div>       			
        		</div>
        		<div class="col-lg-4">
        			<div class="title-report">
        				<i class="fas fa-barcode icons-report"></i>
        				Productos y Existencias
        			</div>
        			<div class="list-reportes">
        				<ul>
        					<li><?= Html::a('Existencias de Inventario', ['reportes/rpt-existencias'], ['class' => 'reportes-link']) ?></li>
                  <li><?= Html::a('Inventario con Stock Mínimo', ['reportes/rpt-stock-minimo'], ['class' => 'reportes-link']) ?></li>
       						<li>Inventario con Menos Rotación</li>
       						<li>Valor del Inventario</li>
       						<li>Hábitos de Consumo</li>
                  <li><?= Html::a('Libro de Precios', ['reportes/rpt-libro-precios'], ['class' => 'reportes-link']) ?></li>                  
       					</ul>
       				</div>         			
        		</div>
        		<div class="col-lg-4">
        			<div class="title-report">
        				<i class="fas fa-money-check-alt icons-report"></i>
        				Gastos y Compras
        			</div>
        			<div class="list-reportes">
        				<ul>
                  <li><?= Html::a('Gastos por Mes/Categoria', '#', [
                    'class' => 'reportes-link',
                    'id' => 'fgastos',                    
                    'data-toggle' => 'modal',
                    'data-target' => '#form_gastos',
                    'data-url' => Url::to(['form-gastos']),
                    'data-pjax' => '0']) ?>
                  </li>                  
                  <li><?= Html::a('Listado de Ordenes de Compra', ['reportes/rpt-ordenes-compra'], ['class' => 'reportes-link']) ?></li>                  
       						<li>Saldo de Proveedores</li>
       					</ul>
       				</div>         			
        		</div>        		        		
        	</div>

        	<br><br>

        	<div class="row mt-4">
        		<div class="col-lg-4">
        			<div class="title-report">
        				<i class="fas fa-chart-pie icons-report"></i>
        				Utilidad
        			</div>
        			<div class="list-reportes">
        				<ul>
        					<li>Total de Utilidad</li>
       					</ul>
       				</div>       			
        		</div>
        		<div class="col-lg-4">
        			<div class="title-report">
        				<i class="fas fa-boxes icons-report"></i>
        				Movimientos de Inventario
        			</div>
        			<div class="list-reportes">
        				<ul>
                  <li><?= Html::a('Movimientos de Mercancia', ['reportes/rpt-mov-mercancia'], ['class' => 'reportes-link']) ?></li>
                  <li><?= Html::a('Auditorias de Inventario', ['reportes/rpt-aud-inventario'], ['class' => 'reportes-link']) ?></li>                  
       					</ul>
       				</div>         			
        		</div>
        		<div class="col-lg-4">
        			<div class="title-report">
        				<i class="fas fa-file-invoice-dollar icons-report"></i>
        				Créditos y Pagos
        			</div>
        			<div class="list-reportes">
        				<ul>
                  <li><?= Html::a('Saldo de Clientes', ['reportes/rpt-saldo-clientes'], ['class' => 'reportes-link']) ?></li>
        					<li>Cuentas por Cobrar</li>
       					</ul>
       				</div>         			
        		</div>        		        		
        	</div>

        	<br><br>

        	<div class="row mt-4 mb-4">
        		<div class="col-lg-4">
        			<div class="title-report">
        				<i class="fas fa-cash-register icons-report"></i>
        				Cajas
        			</div>
        			<div class="list-reportes">
        				<ul>
        					<li>Cuadres de Caja</li>
        					<li>Cierres de Caja por Fecha</li>
       					</ul>
       				</div>       			
        		</div>
        		<div class="col-lg-4">
        			<div class="title-report">
        				<i class="fas fa-sync icons-report"></i>
        				Devoluciones
        			</div>
        			<div class="list-reportes">
        				<ul>
        					<li>Notas de Débito / Crédito</li>
       					</ul>
       				</div>         			
        		</div>
        		<div class="col-lg-4">
        			<div class="title-report">
        				<i class="fas fa-landmark icons-report"></i>
        				Bancos
        			</div>
        			<div class="list-reportes">
        				<ul>
        					<li><?= Html::a('Mis Bancos', ['reportes/rpt-bancos'], ['class' => 'reportes-link']) ?></li>
        					<li><?= Html::a('Movimientos Bancarios', ['reportes/rpt-mov-bancarios'], ['class' => 'reportes-link']) ?></li>
       					</ul>
       				</div>         			
        		</div>        		        		
        	</div>
        	<br>
        </div>
    </div>
</div>	

<?php 
  $this->registerJs(" 
    $(document).on('click', '#fgastos', (function() {
      $.get(
        $(this).data('url'),
        function (data) {
          $('#modalContenedor').html(data);
          $('#ver_movimiento').modal();
        }
      );
    }));        
  ");
?> 