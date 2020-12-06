<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ClientesCategorias */

$this->title = 'Create Clientes Categorias';
$this->params['breadcrumbs'][] = ['label' => 'Clientes Categorias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clientes-categorias-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
