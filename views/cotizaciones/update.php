<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cotizaciones */

$this->title = 'Cotizaciones';
$this->params['breadcrumbs'][] = ['label' => 'Cotizaciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->cotizaciones->nro_documento, 'url' => ['view', 'id' => $model->cotizaciones->id]];
$this->params['breadcrumbs'][] = 'Modificar Cotizaciòn';
?>
<div class="cotizaciones-update">

    <?= $this->render('_form', [
        'model' => $model,
        'clientes' => $clientes,    
    ]) ?>

</div>
