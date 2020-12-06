<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Categorias */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="categorias-form">
    <div class="card card-primary">
        <div class="card-header">Modificar Categoria</div>
        <div class="card-body">
            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-6">
                        <?= $form->field($model, 'categoria')->textInput(['maxlength' => true]) ?>
                    </div>

                    <div class="col-lg-4 ml-5">
                        <?= $form->field($model, 'image')->fileInput() ?>
                    </div>
                </div>
                <?= $form->field($model, 'status')->hiddenInput(['value' => 1])->label(false) ?>

                <div class="row mt-3">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
