<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Medidas */

$this->title = 'Agregar Medida';
$this->params['breadcrumbs'][] = ['label' => 'Medidas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="medidas-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
