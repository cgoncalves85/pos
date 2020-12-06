<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <div class="panel panel-default">   
        <div class="panel-heading"><b><?= Html::encode($this->title) ?></b></div>
        <div class="panel-body" style="padding: 30px 40px">
            <p align="right">
                <?= Html::a('Nuevo Usuario', ['create'], ['class' => 'btn btn-success']) ?>
            </p>

            <?php Pjax::begin(); ?>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,     
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'id',
                    'username',
                    //'auth_key',
                    //'password_hash',
                    //'password_reset_token',
                    'email',
                    'status',
                    'rol_id',
                    //'created_at',
                    //'updated_at',
                    //'verification_token',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>

            <?php Pjax::end(); ?>
        </div>
    </div>    
</div>
