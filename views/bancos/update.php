<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Bancos */

$this->title = 'Modificar Cuenta Bancaria';
$this->params['breadcrumbs'][] = ['label' => 'Bancos', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Modificar Cuenta Bancaria';
?>
<div class="bancos-update">
    <div class="card card-primary">
        <div class="card-header">Modificar Cuenta Bancaria</div>
        <div class="card-body">	
		    <?= $this->render('_form', [
		        'model' => $model,
		        'bancos' => $bancos,
		    ]) ?>
		</div>
	</div>
</div>
