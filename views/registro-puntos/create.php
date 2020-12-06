<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RegistroPuntos */

$this->title = 'Create Registro Puntos';
$this->params['breadcrumbs'][] = ['label' => 'Registro Puntos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="registro-puntos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
