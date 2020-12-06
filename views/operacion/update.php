<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Operacion */

$this->title = 'Permisos';
$this->params['breadcrumbs'][] = ['label' => 'Permisos', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Modificar Permiso';
?>
<div class="operacion-update">

    <?= $this->render('_form', ['model' => $model]) ?>	

</div>
