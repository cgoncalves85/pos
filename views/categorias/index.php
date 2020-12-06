<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap4\ActiveForm;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\CategoriaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categorias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categorias-index">
    <div class="card card-primary">
        <div class="card-header">Nueva Categoria</div>
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
            </div>
            <?= $form->field($model, 'status')->hiddenInput(['value' => 1])->label(false) ?>

            <div class="col-lg-12">
                <div class="form-group">
                    <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

    <div class="card card-primary">
        <div class="card-header">Listado de Categorias</div>
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
                            'attribute'=>'categoria',
                            'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                        ],  

                        [
                            'attribute'=>'imagen',
                            'format' => 'html',
                            'value' => function ($model) {
                                return '<img class="img-thumbnail img-grid" src='.$model->getImageUrl().'>'; 
                            },
                            'width' => '150px',
                            'headerOptions' => ['style' => ['text-align' => 'center']],
                            'contentOptions' => ['style' => ['text-align' => 'center']],
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
