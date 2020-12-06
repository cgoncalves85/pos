<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MovBancarios */

$this->title = 'Modificar Movimiento Bancario';
$this->params['breadcrumbs'][] = ['label' => 'Movimientos Bancarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Modificar Movimiento Bancario';
?>
<div class="mov-bancarios-update">
    <?= $this->render('_form', [
        'model' => $model,
        'tipos' => $tipos,
        'bancos' => $bancos,
    ]) ?>
</div>
