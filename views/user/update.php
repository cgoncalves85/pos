<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Modificar Datos: ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Modificar Datos';
?>
<div class="user-update">

	<div class="panel panel-default">	
		<div class="panel-heading"><b><?= Html::encode($this->title) ?></b></div>
	    <div class="panel-body">
    		<?= $this->render('_form', ['model' => $model]) ?>
		</div>
	</div>	

</div>
