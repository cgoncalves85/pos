<?php

    use yii\helpers\Html;
    use app\models\User;
    $id = Yii::$app->user->id;
    $datos = User::find()->where(['id' => $id])->one();
    $nombre = $datos->nombre_completo;
    $rol = $datos->rol->nombre;

    $fecha = date_create();
    date_timestamp_set($fecha, $datos->created_at);
    $fecha_reg = date_format($fecha, 'd-m-Y H:i:s') ."\n";

?>
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <?= Html::a('Inicio', ['site/index'], ['class' => 'nav-link']) ?>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <?= Html::a('<i class="fas fa-power-off"></i>', ['site/logout'], ['data-method' => 'post', 'class' => 'nav-link']) ?>
        </li>
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <img src="<?=$assetDir?>/img/user2-160x160.jpg" class="user-image img-circle elevation-2" alt="User Image">
                <span class="d-none d-md-inline"><?= $nombre ?></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- User image -->
                <li class="user-header bg-primary">
                    <img src="<?=$assetDir?>/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">

                    <p>
                        <?= $nombre ?>
                        <small><?= $rol ?></small>

                        <small>Registro : <?= $fecha_reg ?></small>
                    </p>
                </li>

                <!-- Menu Footer-->
                <li class="user-footer">
                    <a href="#" class="btn btn-default btn-flat">Perfil</a>
                    <?= Html::a('Salir', ['site/logout'], ['data-method' => 'post', 'class' => 'btn btn-default btn-flat float-right']) ?>
                </li>
            </ul>
        </li>
    </ul>
</nav>