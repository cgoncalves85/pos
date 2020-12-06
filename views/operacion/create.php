<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Operacion */

$this->title = 'Nuevo Permiso';
$this->params['breadcrumbs'][] = ['label' => 'Permisos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="operacion-create">

	<div class="panel panel-default">	
		<div class="panel-heading"><b><?= Html::encode($this->title) ?></b></div>
	    <div class="panel-body">
			<?= $this->render('_form', ['model' => $model]) ?>
		</div>
	</div>

</div>
