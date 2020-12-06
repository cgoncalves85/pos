<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Productos */

$this->title = 'Agregar Producto';
$this->params['breadcrumbs'][] = ['label' => 'Productos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="productos-create">

    <?= $this->render('_form', [
        'model' => $model,
        'categorias' => $categorias,
        'medidas' => $medidas,
    ]) ?>

</div>
