<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap4\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\RolSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Roles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rol-index">
    <div class="card card-primary">
        <div class="card-header">Nuevo Rol</div>
        <div class="card-body">
            <?php $form = ActiveForm::begin(); ?>
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-6">
                        <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 mt-2">
                        <label class="mb-4">Permisos Disponibles</label>
                        <?php $opciones = ArrayHelper::map($tipoOperaciones, 'id', 'descripcion'); ?>

                        <?= $form->field($model, 'operaciones')->checkboxList($opciones, [
                            'item' =>
                            function ($index, $label, $name, $checked, $value) {
                                return "<label class='col-md-4'>".Html::checkbox($name, $checked, [
                                    'value' => $value,
                                    'label' => '<label for="' . $label . '">' . $label . '</label>',
                                ])."</label>";
                            }, 
                            'separator' => false,
                        ])->label(false) ?>
                    </div>                    
                </div>

                <div class="row mt-3">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

    <div class="card card-primary">
        <div class="card-header">Listado de Roles</div>
        <div class="card-body">
            <div class="col-lg-12">
                <?php Pjax::begin(); ?>
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'responsive' => true,
                    'responsiveWrap' => false,
                    'persistResize' => false,        
                    'columns' => [
                        [                      
                            'header' => 'N°',
                            'class' => 'kartik\grid\SerialColumn'
                        ], 

                        [
                            'attribute'=>'nombre',
                            'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                        ], 

                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '<div align="center">{update} &nbsp;  {delete}</div>',
                            'contentOptions' => ['style' => ['vertical-align' => 'middle', 'width' => '100px']],
                        ],
                    ],
                ]); ?>

                <?php Pjax::end(); ?>     
            </div>
        </div>
    </div>
</div>
