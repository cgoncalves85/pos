<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

    <div class="panel panel-default">   
        <div class="panel-heading">Detalles del Usuario: <b><?= Html::encode($this->title) ?></b></div>
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
                    'id',
                    'username',
                    'auth_key',
                    'password_hash',
                    'password_reset_token',
                    'email:email',
                    'status',
                    'rol_id',
                    'created_at',
                    'updated_at',
                    'verification_token',
                ],
            ]) ?>
        </div>
    </div>    

</div>
