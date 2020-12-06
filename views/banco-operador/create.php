<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BancoOperador */

$this->title = 'Create Banco Operador';
$this->params['breadcrumbs'][] = ['label' => 'Banco Operadors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="banco-operador-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
