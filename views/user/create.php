<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Nuevo Usuario';
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

	<div class="panel panel-default">	
		<div class="panel-heading"><b><?= Html::encode($this->title) ?></b></div>
	    <div class="panel-body">
			<?= $this->render('_form', ['model' => $model]) ?>
		</div>
	</div>
	
</div>