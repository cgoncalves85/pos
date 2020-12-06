<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ClientesCategorias */

$this->title = 'Update Clientes Categorias: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Clientes Categorias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="clientes-categorias-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
