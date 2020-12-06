<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Rol */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Perfiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="rol-view">

    <div class="panel panel-default">   
        <div class="panel-heading">Detalles del Perfil: <b><?= Html::encode($this->title) ?></b></div>
        <div class="panel-body" style="padding: 30px 40px">
            <p align="right" style="margin-bottom: 30px">
                <?= Html::a('Modificar Datos', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    //'id',
                    'nombre',
                ],
            ]) ?>
        </div>

        <div class="panel panel-default" style="margin: -20px 40px 45px 40px">  
            <div class="panel-heading"><b>Permisos Asignados</b></div>
            <div class="panel-body" style="padding: 20px">
                <br>
                <?php foreach ($model->operacionesPermitidasList as $operacionPermitida) { ?>
                <div class="listap">
                    <?php echo '<li><b>'.$operacionPermitida['nombre'].': </b>('.$operacionPermitida['descripcion'] . ")</li><br>"; ?>
                </div>
                <?php  } ?>
            </div>
        </div>        
         
    </div>    

</div>


