<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Clientes */

$this->title = 'Clientes';
$this->params['breadcrumbs'][] = ['label' => 'Clientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clientes-create">

    <?= $this->render('_form', [
        'model' => $model,
        'categorias_cliente' => $categorias_cliente,
    ]) ?>

</div>
