<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OrdenCompra */

$this->title = 'Ordenes de Compra';
$this->params['breadcrumbs'][] = ['label' => 'Ordenes de Compra', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ordenCompra->nro_documento, 'url' => ['view', 'id' => $model->ordenCompra->id]];
$this->params['breadcrumbs'][] = 'Modificar Orden de Compra';
?>
<div class="orden-compra-update">

    <?= $this->render('_form', [
        'model' => $model,
        'proveedores' => $proveedores,    
    ]) ?>

</div>
