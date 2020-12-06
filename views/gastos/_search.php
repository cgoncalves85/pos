<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\search\GastoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gastos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'descripcion') ?>

    <?= $form->field($model, 'proveedor_id') ?>

    <?= $form->field($model, 'fecha') ?>

    <?= $form->field($model, 'tienda_id') ?>

    <?php // echo $form->field($model, 'forma_pago_id') ?>

    <?php // echo $form->field($model, 'monto') ?>

    <?php // echo $form->field($model, 'impuesto_id') ?>

    <?php // echo $form->field($model, 'gastos_categorias_id') ?>

    <?php // echo $form->field($model, 'gastos_subcategorias_id') ?>

    <?php // echo $form->field($model, 'banco_id') ?>

    <?php // echo $form->field($model, 'nro_referencia') ?>

    <?php // echo $form->field($model, 'nota') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
