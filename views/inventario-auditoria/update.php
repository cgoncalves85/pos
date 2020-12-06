<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\InventarioAuditoria */

$this->title = 'Modificar Auditoria de Inventario';
$this->params['breadcrumbs'][] = ['label' => 'Auditoria de Inventario', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Modificar Auditoria de Inventario';
?>
<div class="inventario-auditoria-update">

    <?= $this->render('_form', [
        'model' => $model,
        'tiendas' => $tiendas,
    ]) ?>

</div>
