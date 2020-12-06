<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RegistroPuntos */

$this->title = 'Update Registro Puntos: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Registro Puntos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="registro-puntos-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
