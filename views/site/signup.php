<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap4\ActiveForm;
use kartik\select2\Select2;
use app\models\Tiendas;
use app\models\Rol;

$this->title = 'Registro de Usuario';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="user-signup">
    <div class="card card-primary">
        <div class="card-header">Nuevo Usuario</div>
        <div class="card-body">    
            <?php $form = ActiveForm::begin(['id' => 'login-form']) ?>
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-4">
                        <?= $form->field($model,'nombre_completo')->textInput(['maxlength' => true]) ?>
                    </div>

                    <div class="col-lg-4">
                        <?= $form->field($model,'username')->textInput(['maxlength' => true]) ?>
                    </div>

                    <div class="col-lg-4">
                        <?= $form->field($model,'email')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4">
                        <?= $form->field($model,'password')->textInput(['maxlength' => true]) ?>
                    </div>

                    <div class="col-lg-4">
                        <?= $form->field($model, 'tienda_id')->widget(Select2::classname(), [
                            'data' => $tiendas,
                            'options' => ['placeholder' => 'Seleccione Tienda'],
                            'pluginOptions' => [
                              'allowClear' => true
                            ],
                        ]) ?>
                    </div>

                    <div class="col-lg-4">
                        <?= $form->field($model, 'rol_id')->widget(Select2::classname(), [
                            'data' => $roles,
                            'options' => ['placeholder' => 'Seleccione Rol'],
                            'pluginOptions' => [
                              'allowClear' => true
                            ],
                        ]) ?>
                    </div> 

                </div>

                <div class="row mt-4">
                    <div class="col-lg-1">     
                        <div class="form-group">
                            <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <?= Html::a('Administrar Roles', ['rol/index'], ['class' => 'btn btn-success']) ?>
                        </div>                        
                    </div>
                </div>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

    <div class="card card-primary">
        <div class="card-header">Listado de Usuarios</div>
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
                            'attribute'=>'nombre_completo',
                            'format' => 'html',
                            'value' => function ($model) {
                                return '<b>'.$model->nombre_completo.'</b><br><a href="mailto:'.$model->email.'">'.$model->email.'</a>'; 
                            },                
                            'width' => '400px',
                            'headerOptions' => ['style' => ['text-align' => 'center']],
                            'contentOptions' => ['style' => ['vertical-align' => 'middle']],            
                        ],

                        [
                            'attribute'=>'username',
                            'width' => '250px',
                            'headerOptions' => ['style' => ['text-align' => 'center']],
                            'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                        ],  

                        [
                            'attribute' => 'tienda_id',    
                            'value' => 'tienda.nombre',
                            'format' => 'text',
                            'filter' => Select2::widget([
                                'model' => $searchModel,
                                'attribute' => 'tienda_id',
                                'data' => ArrayHelper::map(Tiendas::find()->orderBy('nombre')->all(), 'id', 'nombre'),
                                'options' => [
                                    'placeholder' => '',
                                    'class' => 'form-control',
                                ],
                                'pluginOptions' => [ 
                                    'allowClear' => true,
                                ],
                            ]),
                            'width' => '350px',
                            'headerOptions' => ['style' => ['text-align' => 'center']],
                            'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                        ],  

                        [
                            'attribute' => 'rol_id',    
                            'value' => 'rol.nombre',
                            'format' => 'text',
                            'filter' => Select2::widget([
                                'model' => $searchModel,
                                'attribute' => 'rol_id',
                                'data' => ArrayHelper::map(Rol::find()->orderBy('nombre')->all(), 'id', 'nombre'),
                                'options' => [
                                    'placeholder' => '',
                                    'class' => 'form-control',
                                ],
                                'pluginOptions' => [ 
                                    'allowClear' => true,
                                ],
                            ]),
                            'width' => '350px',
                            'headerOptions' => ['style' => ['text-align' => 'center']],
                            'contentOptions' => ['style' => ['vertical-align' => 'middle']],
                        ],                                                                        

                        /*
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '<div align="center">{update} &nbsp;  {delete}</div>',
                            'contentOptions' => ['style' => ['vertical-align' => 'middle', 'width' => '120px']],
                        ],
                        */
                    ],
                ]); ?>

                <?php Pjax::end(); ?>
            </div>
        </div>
    </div>
</div>