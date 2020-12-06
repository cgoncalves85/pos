<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GastosCategorias */

$this->title = 'Update Gastos Categorias: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Gastos Categorias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="gastos-categorias-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
