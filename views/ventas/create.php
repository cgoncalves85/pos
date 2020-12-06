<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ventas */

$this->title = 'Nueva Venta';
$this->params['breadcrumbs'][] = ['label' => 'Ventas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ventas-create">

    <?= $this->render('_form', [
        'model' => $model,
        'clientes' => $clientes,
        'metodos_pago' => $metodos_pago,
        'listaP' => $listaP,
        'categorias' => $categorias,
        'productos' => $productos,
    ]) ?>

</div>
