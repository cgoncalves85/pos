<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Bonos */

$this->title = 'Update Bonos: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Bonos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bonos-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
