<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Proveedores */

$this->title = 'Proveedores';
$this->params['breadcrumbs'][] = ['label' => 'Proveedores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="proveedores-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
