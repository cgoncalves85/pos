<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LibroPrecios */

$this->title = 'Update Libro Precios: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Libro Precios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="libro-precios-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
