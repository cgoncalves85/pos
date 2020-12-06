<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Gastos */

$this->title = 'Modificar Gasto';
$this->params['breadcrumbs'][] = ['label' => 'Gastos', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Modificar Gasto';
?>
<div class="gastos-update">
    <?= $this->render('_form', [
        'model' => $model,
        'proveedores' => $proveedores,
        'tiendas' => $tiendas,
        'formas' => $formas,
        'impuestos' => $impuestos,
        'cuentas' => $cuentas,
        'bancos' => $bancos,
        'categorias' => $categorias,         
    ]) ?>

</div>
