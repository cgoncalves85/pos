<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cajas */

$this->title = 'Cajas';
$this->params['breadcrumbs'][] = ['label' => 'Cajas', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Modificar Caja';
?>
<div class="cajas-update">

    <?= $this->render('_form', [
        'model' => $model,
        'tiendas' => $tiendas,
    ]) ?>

</div>
