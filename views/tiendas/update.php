<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tiendas */

$this->title = 'Tiendas';
$this->params['breadcrumbs'][] = ['label' => 'Tiendas', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Modificar Tienda';
?>
<div class="tiendas-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
