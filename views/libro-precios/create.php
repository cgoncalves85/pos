<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LibroPrecios */

$this->title = 'Create Libro Precios';
$this->params['breadcrumbs'][] = ['label' => 'Libro Precios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="libro-precios-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
