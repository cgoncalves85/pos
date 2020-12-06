<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MovBancarioTipo */

$this->title = 'Modificar Tipo de Movimiento Bancario';
$this->params['breadcrumbs'][] = ['label' => 'Tipos de Movimientos', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Modificar Tipo de Movimiento Bancario';
?>
<div class="mov-bancario-tipo-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
