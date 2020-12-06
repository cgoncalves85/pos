<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OrdenCompra */

$this->title = 'Nueva Orden de Compra';
$this->params['breadcrumbs'][] = ['label' => 'Ordenes de Compras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orden-compra-create">

    <?= $this->render('_form', [
        'model' => $model,
        'proveedores' => $proveedores,
    ]) ?>

</div>
