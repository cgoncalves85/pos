<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Medidas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="medidas-form">
	<div class="card card-primary">
		<div class="card-header">Modificar Unidad de Medida</div>
		<div class="card-body">
			<?php $form = ActiveForm::begin(); ?>
			<div class="col-lg-12">
				<div class="row">
					<div class="col-lg-4">
		    			<?= $form->field($model, 'medida')->textInput(['maxlength' => true]) ?>
		    		</div>

					<div class="col-lg-2">
		    			<?= $form->field($model, 'abv_med')->textInput(['maxlength' => true]) ?>
		    		</div>    		

		    		<div class="col-lg-4">
		    			<?= $form->field($model, 'status')->hiddenInput(['value' => 1])->label(false) ?>
		    		</div>
		    	</div>

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
