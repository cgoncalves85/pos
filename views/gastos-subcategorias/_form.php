<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\GastosSubcategorias */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="gastos-subcategorias-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'gastos_categorias_id')->widget(Select2::classname(), [
        'data' => $categorias,
        'options' => ['placeholder' => 'Seleccione Categoria'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <?= $form->field($model, 'subcategoria')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput(['value' => 1]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
