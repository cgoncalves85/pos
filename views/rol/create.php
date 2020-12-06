<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Rol */

$this->title = 'Nuevo Perfil';
$this->params['breadcrumbs'][] = ['label' => 'Perfiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rol-create">

	<div class="panel panel-default">	
		<div class="panel-heading"><b><?= Html::encode($this->title) ?></b></div>
	    <div class="panel-body">
			<?= $this->render('_form', ['model' => $model,'tipoOperaciones' => $tipoOperaciones]) ?>
		</div>
	</div>

</div>
