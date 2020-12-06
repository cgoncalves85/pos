<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MovBancarioTipo */

$this->title = 'Nuevo Tipo de Movimiento Bancario';
$this->params['breadcrumbs'][] = ['label' => 'Tipos de Movimientos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mov-bancario-tipo-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
