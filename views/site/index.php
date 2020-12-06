<?php

use yii\helpers\Html;
use dosamigos\chartjs\ChartJs;

$this->title = 'Menú Principal';
$this->params['breadcrumbs'] = [['label' => $this->title]];
?>
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-3 col-6">
			<!-- small box -->
			<div class="small-box bg-info">
				<div class="inner">
					<h3><?= $nro_ventas ?></h3>

					<h5><p class="text-white lbl-view text-bold">Ventas</p></h5>
				</div>
				<div class="icon">
					<i class="fas fa-shopping-basket"></i>
				</div>
				<?= Html::a('<b>Ver Más <i class="fas fa-arrow-circle-right"></i></b>', ['ventas/index'], ['class' => 'small-box-footer lbl-view']) ?>
			</div>
		</div>
		<!-- ./col -->
		<div class="col-lg-3 col-6">
			<!-- small box -->
			<div class="small-box bg-success">
				<div class="inner">
					<h3><?= $nro_clientes ?></h3>

					<h5><p class="text-white lbl-view text-bold">Clientes</p></h5>
				</div>
				<div class="icon">
					<i class="fas fa-user-circle"></i>
				</div>
				<?= Html::a('<b>Ver Más <i class="fas fa-arrow-circle-right"></i></b>', ['clientes/index'], ['class' => 'small-box-footer lbl-view']) ?>
			</div>
		</div>
		<!-- ./col -->
		<div class="col-lg-3 col-6">
			<!-- small box -->
			<div class="small-box bg-warning">
				<div class="inner">
					<h3 class="text-white"><?= $nro_proveedores ?></h3>

					<h5><p class="text-white lbl-view text-bold">Proveedores</p></h5>
				</div>
				<div class="icon">
					<i class="fas fa-truck"></i>
				</div>
				<?= Html::a('<b>Ver Más <i class="fas fa-arrow-circle-right"></i></b>', ['proveedores/index'], [
					'class' => 'small-box-footer lbl-view',
					'style' => ['color' => '#FFF !important']
				]) ?>
			</div>
		</div>
		<!-- ./col -->
		<div class="col-lg-3 col-6">
			<!-- small box -->
			<div class="small-box bg-danger">
				<div class="inner">
					<h3><?= $nro_productos ?></h3>

					<h5><p class="text-white lbl-view text-bold">Productos</p></h5>
				</div>
				<div class="icon">
					<i class="fas fa-barcode"></i>
				</div>
				<?= Html::a('<b>Ver Más <i class="fas fa-arrow-circle-right"></i></b>', ['productos/index'], ['class' => 'small-box-footer lbl-view']) ?>
			</div>
		</div>
		<!-- ./col -->
	</div>

	<div class="row mt-4">
		<div class="col-lg-6">

			<div class="card card-graph mb-4">
				<div class="card-header"><b>VENTAS</b></div>
				<div class="card-body">


					<?= ChartJs::widget([
					    'type' => 'line',
					    'options' => [
					        'height' => 170,
					        'width' => 400
					    ],
					    'data' => [
					        'labels' => ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
					        'datasets' => [
					            [
					                'label' => "Cantidad de Ventas",
					                'backgroundColor' => "#17a2b8",
					                'borderColor' => "rgba(179,181,198,1)",
					                'pointBackgroundColor' => "rgba(179,181,198,1)",
					                'pointBorderColor' => "#fff",
					                'pointHoverBackgroundColor' => "#fff",
					                'pointHoverBorderColor' => "rgba(179,181,198,1)",
					                'data' => $datos
					            ],
					        ]
					    ]
					]);
					?>
				</div>
			</div>
		</div>

		<div class="col-lg-6">
			<div class="row">
				<div class="col-lg-6 col-1">
					<!-- small box -->
					<div class="small-box bg-secondary">
						<div class="inner">
							<h3><?= $nro_existencias ?></h3>

							<h5><p class="text-white lbl-view text-bold">Existencias de Inv.</p></h5>
						</div>
						<div class="icon">
							<i class="fas fa-archive"></i>
						</div>
						<?= Html::a('<b>Ver Más <i class="fas fa-arrow-circle-right"></i></b>', ['existencias/index'], ['class' => 'small-box-footer lbl-view']) ?>
					</div>
				</div>

				<div class="col-lg-6 col-1">
					<!-- small box -->
					<div class="small-box bg-purple">
						<div class="inner">
							<h3><?= $nro_gastos ?></h3>

							<h5><p class="text-white lbl-view text-bold">Gastos</p></h5>
						</div>
						<div class="icon">
							<i class="fas fa-money-check-alt"></i>
						</div>
						<?= Html::a('<b>Ver Más <i class="fas fa-arrow-circle-right"></i></b>', ['gastos/index'], ['class' => 'small-box-footer lbl-view']) ?>
					</div>
				</div>
			</div>

			<div class="row mt-4">
				<div class="col-lg-6 col-1">
					<!-- small box -->
					<div class="small-box bg-blue">
						<div class="inner">
							<h3><?= $nro_cupones ?></h3>

							<h5><p class="text-white lbl-view text-bold">Cupones de Desc.</p></h5>
						</div>
						<div class="icon">
							<i class="fas fa-tags"></i>
						</div>
						<?= Html::a('<b>Ver Más <i class="fas fa-arrow-circle-right"></i></b>', ['cupones-lista/index'], ['class' => 'small-box-footer lbl-view']) ?>
					</div>
				</div>

				<div class="col-lg-6 col-1">
					<!-- small box -->
					<div class="small-box bg-orange">
						<div class="inner">
							<h3 class="text-white"><?= $nro_bancos ?></h3>

							<h5><p class="text-white lbl-view text-bold">Cuentas Bancarias</p></h5>
						</div>
						<div class="icon">
							<i class="fas fa-landmark"></i>
						</div>
						<?= Html::a('<b>Ver Más <i class="fas fa-arrow-circle-right"></i></b>', ['bancos/index'], ['class' => 'small-box-footer lbl-view', 'style' => ['color' => '#FFF !important']]) ?>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>