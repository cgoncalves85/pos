<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Proveedores */

$this->title = 'Modificar Proveedor : '.$model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Proveedores', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Modificar Proveedor';
?>
<div class="proveedores-update">
    <div class="card card-primary">
        <div class="card-header">Modificar Proveedor</div>
        <div class="card-body">
		    <?= $this->render('_form', [
		        'model' => $model,
		    ]) ?>
		</div>
	</div>
</div>
