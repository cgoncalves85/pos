<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\Productos;

$buscaPro = Productos::find()->where(['status' => 1])->all();
$listaP = ArrayHelper::map($buscaPro, 'id', 'nombre');

?>

<div class="row producto">
  <div class="col-lg-4">
    <?= $form->field($producto, 'producto_id')->dropDownList($listaP, [
      'id' => "Productos_{$key}producto_id",
      'name' => "Productos[$key][producto_id]"
    ])->label(false) ?>
  </div>

  <div class="col-lg-1">
    <?= $form->field($producto, 'cantidad')->textInput([
      'id' => "Productos_{$key}_cantidad",
      'name' => "Productos[$key][cantidad]"
    ])->label(false) ?>
  </div>

  <div class="col-lg-1">
    <?= $form->field($producto, 'cantidad_final')->textInput([
      'id' => "Productos_{$key}_cantidad_final",
      'name' => "Productos[$key][cantidad_final]"
    ])->label(false) ?>
  </div>  

  <div class="col-lg-5">
    <?= $form->field($producto, 'observacion')->textarea([
      'rows' => '1',
      'id' => "Productos_{$key}observacion",
      'name' => "Productos[$key][observacion]"])->label(false) ?>
  </div>  

  <div class="col-lg-1">
    <?= Html::a('Eliminar' , 'javascript:void(0);', [
      'class' => 'venta-eliminar-producto-boton btn btn-danger btn-sm mt-1',
    ]) ?>
  </div>
</div>