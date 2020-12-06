<?php
    use app\models\User;
    $id = Yii::$app->user->id;
    $datos = User::find()->where(['id' => $id])->one();
    $nombre = $datos->nombre_completo;
    $rol = $datos->rol->nombre;

?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?=\yii\helpers\Url::home()?>" class="brand-link">
        <img src="<?=$assetDir?>/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">Epets - POS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?=$assetDir?>/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= $nombre ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2 mb-4">

            <?php
            echo \hail812\adminlte3\widgets\Menu::widget([
                'items' => [


                    ['label' => 'VENTAS', 'header' => true],
                    ['label' => 'Vender',  'icon' => 'shopping-basket', 'url' => ['ventas/vender']],
                    ['label' => 'Historico de Ventas',  'icon' => 'list', 'url' => ['ventas/index']],

                    ['label' => 'Cierre de Caja (Cajero)',  'icon' => 'cash-register', 'url' => ['ventas/cerrar-caja']],
                    ['label' => 'Cierre de Caja',  'icon' => 'cash-register', 'url' => ['ventas/cierra-caja']],
                    ['label' => 'Cotizaciones',  'icon' => 'funnel-dollar', 'url' => ['cotizaciones/index']],
                    ['label' => 'Libro de Precios',  'icon' => 'book-open', 'url' => ['libro-precios/index']],

                    ['label' => 'FIDELIZACIÓN', 'header' => true],
                    ['label' => 'Cupones de Descuento',  'icon' => 'tags', 'url' => ['cupones-lista/index']],
                    ['label' => 'Registro de Puntos',  'icon' => 'heart', 'url' => ['registro-puntos/index']],
                    ['label' => 'Bonos / Premios',  'icon' => 'gift', 'url' => ['bonos/index']], 
                    ['label' => 'Bonos Asignados',  'icon' => 'hand-holding-heart ', 'url' => ['bonos-asignados/index']],

                    ['label' => 'SISTEMA', 'header' => true],
                    ['label' => 'Registro de Usuarios',  'icon' => 'users', 'url' => ['site/signup']],
                    ['label' => 'Permisos',  'icon' => 'address-card', 'url' => ['operacion/index']],
                    ['label' => 'Roles',  'icon' => 'address-card', 'url' => ['rol/index']],
                    ['label' => 'Tiendas',  'icon' => 'store-alt', 'url' => ['tiendas/index']],
                    ['label' => 'Cajas',  'icon' => 'cash-register', 'url' => ['cajas/index']],
                    ['label' => 'Reportes',  'icon' => 'th-list', 'url' => ['reportes/index']],

                    ['label' => 'CONTACTOS', 'header' => true],
                    ['label' => 'Clientes',  'icon' => 'user-circle', 'url' => ['clientes/index']],
                    ['label' => 'Proveedores',  'icon' => 'truck', 'url' => ['proveedores/index']],

                    //['label' => 'Servicios',  'icon' => 'tint', 'url' => ['compras/servicios-index']],

                    ['label' => 'INVENTARIO', 'header' => true],
                    ['label' => 'Productos',  'icon' => 'barcode', 'url' => ['productos/index']],
                    ['label' => 'Categorias',  'icon' => 'th-list', 'url' => ['categorias/index']],
                    [
                        'label' => 'Mov. de Inventario', 'icon' => 'archive',
                        'items' => [
                            ['label' => 'Ingresos',  'icon' => 'arrow-left', 'url' => ['inventario/ingreso']],
                            ['label' => 'Egresos',  'icon' => 'arrow-right', 'url' => ['inventario/egreso']],
                            //['label' => 'Traslados',  'icon' => 'cubes', 'url' => ['inventario/traslado']],
                            ['label' => 'Existencias',  'icon' => 'list', 'url' => ['existencias/index']]
                        ]
                    ], 
                    ['label' => 'Auditoria de Inventario',  'icon' => 'tasks', 'url' => ['inventario-auditoria/index']],

                    ['label' => 'COMPRAS', 'header' => true],
                    ['label' => 'Gastos',  'icon' => 'money-check-alt', 'url' => ['gastos/index']],
                    ['label' => 'Ordenes de Compra',  'icon' => 'file-invoice', 'url' => ['orden-compra/index']], 
                    ['label' => 'Bancos',  'icon' => 'landmark', 'url' => ['bancos/index']],
                    ['label' => 'Movimientos Bancarios',  'icon' => 'money-bill-alt', 'url' => ['mov-bancarios/index']],
                ],
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>