<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cajas */

$this->title = 'Create Cajas';
$this->params['breadcrumbs'][] = ['label' => 'Cajas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cajas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
