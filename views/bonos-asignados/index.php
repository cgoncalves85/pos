<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\BonoAsignadoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bonos Asignados';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bonos-asignados-index">

    <p align="right">
        <?= Html::a('Create Bonos Asignados', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'cliente_id',
            'bono_id',
            'nro_documento',
            'fecha',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
