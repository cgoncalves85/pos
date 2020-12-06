<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GastosSubcategorias */

$this->title = 'Create Gastos Subcategorias';
$this->params['breadcrumbs'][] = ['label' => 'Gastos Subcategorias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gastos-subcategorias-create">

    <?= $this->render('_form', [
        'model' => $model,
        'categorias' => $categorias,
    ]) ?>

</div>
