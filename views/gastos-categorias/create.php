<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GastosCategorias */

$this->title = 'Create Gastos Categorias';
$this->params['breadcrumbs'][] = ['label' => 'Gastos Categorias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gastos-categorias-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
