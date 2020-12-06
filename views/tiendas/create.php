<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tiendas */

$this->title = 'Create Tiendas';
$this->params['breadcrumbs'][] = ['label' => 'Tiendas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tiendas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
