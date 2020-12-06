<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\InventarioAuditoria */

$this->title = 'Create Inventario Auditoria';
$this->params['breadcrumbs'][] = ['label' => 'Inventario Auditorias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inventario-auditoria-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
