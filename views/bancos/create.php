<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Bancos */

$this->title = 'Create Bancos';
$this->params['breadcrumbs'][] = ['label' => 'Bancos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bancos-create">
    <?= $this->render('_form_create', [
        'model' => $model,
        'bancos' => $bancos,
    ]) ?>
</div>
