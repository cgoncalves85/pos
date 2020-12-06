<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Medidas */

$this->title = 'Unidades de Medida';
$this->params['breadcrumbs'][] = ['label' => 'Medidas', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Modificar Unidad de Medida';
?>
<div class="medidas-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
