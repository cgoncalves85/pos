<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CuponesLista */

$this->title = 'Modificar Lista de Cupones';
$this->params['breadcrumbs'][] = ['label' => 'Cupones de Descuento', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Modificar Lista';
?>
<div class="cupones-lista-update">

    <?= $this->render('_form', [
        'model' => $model,
        'listaCupones' => $listaCupones,
    ]) ?>

</div>
