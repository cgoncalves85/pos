<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Categorias */

$this->title = 'Categorias';
$this->params['breadcrumbs'][] = ['label' => 'Categorias', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Modificar Categoria';
?>
<div class="categorias-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
