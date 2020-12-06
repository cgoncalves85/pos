<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Productos */

$this->title = 'Productos';
$this->params['breadcrumbs'][] = ['label' => 'Productos', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Modificar Producto';
?>
<div class="productos-update">

    <?= $this->render('_form', [
        'model' => $model,
        'categorias' => $categorias,
        'impuestos' => $impuestos,
        'medidas' => $medidas,
    ]) ?>

</div>
