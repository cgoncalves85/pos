<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Bonos */

$this->title = 'Create Bonos';
$this->params['breadcrumbs'][] = ['label' => 'Bonos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bonos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
