<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>
        <br>
        <div class="col-md-4">
            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'status')->textInput() ?>
        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'rol_id')->textInput() ?>
        </div>        

        <div class="col-md-4">
            <?= $form->field($model, 'password_hash')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'password_reset_token')->textInput(['maxlength' => true]) ?>
        </div>   
    
        <div class="col-md-4">
            <?= $form->field($model, 'auth_key')->textInput(['maxlength' => true]) ?> 
        </div>        

        <div class="col-md-4">
            <?= $form->field($model, 'created_at')->textInput() ?>
        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'updated_at')->textInput() ?>
        </div>  
    
        <div class="col-md-4">
            <?= $form->field($model, 'verification_token')->textInput(['maxlength' => true]) ?>
        </div> 

        <div class="col-md-8"></div>
    
        <div class="col-md-12">
            <div align="right" class="form-group">
                <?= Html::submitButton('Guardar Datos', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    <?php ActiveForm::end(); ?>

</div>
