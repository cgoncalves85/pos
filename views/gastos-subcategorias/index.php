<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\GastosSubcategoriaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Gastos Subcategorias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gastos-subcategorias-index">

    <p align="right">
        <?= Html::a('Create Gastos Subcategorias', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'gastos_categorias_id',
            'subcategoria',
            'status',
            'created_at',
            //'created_by',
            //'updated_at',
            //'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
