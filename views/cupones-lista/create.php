<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CuponesLista */

$this->title = 'Create Cupones Lista';
$this->params['breadcrumbs'][] = ['label' => 'Cupones Listas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cupones-lista-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
