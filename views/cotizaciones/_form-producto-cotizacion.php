<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\Productos;

$buscaPro = Productos::find()->where(['status' => 1])->all();
$listaP = ArrayHelper::map($buscaPro, 'id', 'nombre');

?>

<div class="row producto">
  <div class="col-lg-1">
    <?= $form->field($producto, 'cantidad')->textInput([
      'id' => "Productos_{$key}_cantidad",
      'name' => "Productos[$key][cantidad]"
    ])->label(false) ?>
  </div>
  <div class="col-lg-6">
    <?= $form->field($producto, 'producto_id')->dropDownList($listaP, [
      'id' => "Productos_{$key}producto_id",
      'name' => "Productos[$key][producto_id]"
    ])->label(false) ?>

  </div>  
  <div class="col-lg-2">
    <?= $form->field($producto, 'precio_unitario')->textInput([
      'maxlength' => true,
      'id' => "Productos_{$key}precio_unitario",
      'name' => "Productos[$key][precio_unitario]"])->label(false) ?>
  </div>
  <div class="col-lg-2">
    <?= $form->field($producto, 'precio')->textInput([
      'maxlength' => true,
      'id' => "Productos_{$key}precio",
      'name' => "Productos[$key][precio]"])->label(false) ?>
  </div>  
  <div class="col-lg-1">
    <?= Html::a('Eliminar' , 'javascript:void(0);', [
      'class' => 'venta-eliminar-producto-boton btn btn-danger btn-sm mt-1',
    ]) ?>
  </div>
</div>