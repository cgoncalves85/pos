<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BonosAsignados */

$this->title = 'Update Bonos Asignados: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Bonos Asignados', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bonos-asignados-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
