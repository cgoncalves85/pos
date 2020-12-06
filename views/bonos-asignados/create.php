<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BonosAsignados */

$this->title = 'Create Bonos Asignados';
$this->params['breadcrumbs'][] = ['label' => 'Bonos Asignados', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bonos-asignados-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
