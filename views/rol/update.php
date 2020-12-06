<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Rol */

$this->title = 'Roles';
$this->params['breadcrumbs'][] = ['label' => 'Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Modificar Rol';
?>
<div class="rol-update">
    
    <?= $this->render('_form', ['model' => $model,'tipoOperaciones' => $tipoOperaciones]) ?>

</div>
