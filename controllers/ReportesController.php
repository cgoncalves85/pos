<?php

namespace app\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use app\models\User;
use app\models\Ventas;
use app\models\GastosCategorias;

class ReportesController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionRptVentas() 
    {
        $query = (new \yii\db\Query())
            ->select(['clientes.nombre', 'ventas.nro_documento', 'productos.nombre as producto', 'ventas_productos.cantidad', 'ventas.subtotal', 'ventas.impuesto', 'ventas.total', 'forma_pago.descripcion as forma_pago', 'ventas.fecha', 'cajas.descripcion as caja'])
            ->from('ventas_productos')
            ->leftJoin('ventas', 'ventas_productos.venta_id = ventas.id')
            ->leftJoin('clientes', 'ventas.cliente_id = clientes.id')
            ->leftJoin('productos', 'ventas_productos.producto_id = productos.id')
            ->leftJoin('forma_pago', 'ventas.forma_pago_id = forma_pago.id')
            ->leftJoin('cajas', 'ventas.caja_id = cajas.id')
            ->where(['ventas.status' => '1'])
            ->all();

		$file = \Yii::createObject([
		    'class' => 'codemix\excelexport\ExcelFile',
		    'sheets' => [
		        'Ventas' => [
		            'data' => $query,
		            'titles' => ['Nombre del Cliente', 'N° de Referencia', 'Producto', 'Cantidad', 'Subtotal', 'Impuesto', 'Total', 'Forma de Pago', 'Fecha', 'Caja'],
		        ],
		    ]
		]);

		$file->send('rptVentas.xlsx');
    }

    public function actionRptVentasCategoria() 
    {
        $query = (new \yii\db\Query())
            ->select(['categorias.categoria', 'sum(ventas.subtotal) as subtotal', 'sum(ventas.impuesto) as impuesto', 'sum(ventas.total) as total'])
            ->from('ventas_productos')
            ->join('LEFT JOIN', 'ventas', 'ventas_productos.venta_id = ventas.id')
            ->join('LEFT JOIN', 'productos', 'ventas_productos.producto_id = productos.id')
            ->join('LEFT JOIN', 'categorias', 'productos.categoria_id = categorias.id')
            ->groupBy('categorias.id')
            ->all();

		$file = \Yii::createObject([
		    'class' => 'codemix\excelexport\ExcelFile',
		    'sheets' => [

		        'VentasXcategoria' => [
		            'data' => $query,
		            'titles' => ['Nombre de la Categoria', 'Subtotal', 'Impuesto', 'Total'],
		        ],
		    ]
		]);

		$file->send('rptVentasXcategoria.xlsx');
    } 

    public function actionRptVentasPago() 
    {
        $query = (new \yii\db\Query())
            ->select(['forma_pago.descripcion as forma_pago', 'sum(ventas.subtotal) as subtotal', 'sum(ventas.impuesto) as impuesto', 'sum(ventas.total) as total'])
            ->from('ventas_productos')
            ->join('LEFT JOIN', 'ventas', 'ventas_productos.venta_id = ventas.id')
            ->join('LEFT JOIN', 'forma_pago', 'ventas.forma_pago_id = forma_pago.id')
            ->groupBy('forma_pago.id')
            ->all();

		$file = \Yii::createObject([
		    'class' => 'codemix\excelexport\ExcelFile',
		    'sheets' => [

		        'VentasXformaPago' => [
		            'data' => $query,
		            'titles' => ['Forma de Pago', 'Subtotal', 'Impuesto', 'Total'],
		        ],
		    ]
		]);

		$file->send('rptVentasXformaPago.xlsx');
    }  

    public function actionRptVentasAtributo() 
    {
        $query = (new \yii\db\Query())
            ->select(['productos.nombre', 'sum(ventas_productos.cantidad)', 'medidas.medida', 'sum(ventas.subtotal) as subtotal', 'sum(ventas.impuesto) as impuesto', 'sum(ventas.total) as total'])
            ->from('ventas_productos')
            ->join('LEFT JOIN', 'ventas', 'ventas_productos.venta_id = ventas.id')
            ->join('LEFT JOIN', 'productos', 'ventas_productos.producto_id = productos.id')
            ->join('LEFT JOIN', 'categorias', 'productos.categoria_id = categorias.id')
            ->join('LEFT JOIN', 'medidas', 'productos.medida_id = medidas.id')
            ->groupBy('productos.id')
            ->all();

		$file = \Yii::createObject([
		    'class' => 'codemix\excelexport\ExcelFile',
		    'sheets' => [

		        'VentasXatributo' => [
		            'data' => $query,
		            'titles' => ['Nombre del Producto', 'Cantidad', 'Unidad de Medida', 'Subtotal', 'Impuesto', 'Total'],
		        ],
		    ]
		]);

		$file->send('rptVentasXatributo.xlsx');
    }          

    public function actionRptProductosCliente() 
    {
        $query = (new \yii\db\Query())
            ->select(['clientes.nombre', 'productos.nombre as producto', 'ventas_productos.cantidad'])
            ->from('ventas_productos')
            ->leftJoin('ventas', 'ventas_productos.venta_id = ventas.id')
            ->leftJoin('clientes', 'ventas.cliente_id = clientes.id')
            ->leftJoin('productos', 'ventas_productos.producto_id = productos.id')
            ->where(['ventas.status' => '1'])
            ->all();

		$file = \Yii::createObject([
		    'class' => 'codemix\excelexport\ExcelFile',
		    'sheets' => [

		        'ProductosXcliente' => [
		            'data' => $query,
		            'titles' => ['Nombre del Cliente', 'Producto', 'Cantidad'],
		        ],
		    ]
		]);

		$file->send('rptProductosXcliente.xlsx');
    }

    public function actionRptVentasVendedor() 
    {
        $query = (new \yii\db\Query())
            ->select(['user.nombre_completo as vendedor', 'clientes.nombre', 'ventas.nro_documento', 'productos.nombre as producto', 'ventas_productos.cantidad', 'ventas.subtotal', 'ventas.impuesto', 'ventas.total', 'forma_pago.descripcion as forma_pago', 'ventas.fecha', 'cajas.descripcion as caja'])
            ->from('ventas_productos')
            ->leftJoin('ventas', 'ventas_productos.venta_id = ventas.id')
            ->leftJoin('clientes', 'ventas.cliente_id = clientes.id')
            ->leftJoin('productos', 'ventas_productos.producto_id = productos.id')
            ->leftJoin('forma_pago', 'ventas.forma_pago_id = forma_pago.id')
            ->leftJoin('cajas', 'ventas.caja_id = cajas.id')
            ->leftJoin('user', 'ventas.user_id = user.id')
            ->where(['ventas.status' => '1'])
            ->all();

		$file = \Yii::createObject([
		    'class' => 'codemix\excelexport\ExcelFile',
		    'sheets' => [
		        'VentasXvendedor' => [
		            'data' => $query,
		            'titles' => ['Nombre del Vendedor', 'Nombre del Cliente', 'N° de Referencia', 'Producto', 'Cantidad', 'Subtotal', 'Impuesto', 'Total', 'Forma de Pago', 'Fecha', 'Caja'],
		        ],
		    ]
		]);

		$file->send('rptVentasXVendedor.xlsx');
    }

    public function actionRptExistencias() 
    {
        $id_user = Yii::$app->user->id;
        $datos_user = User::find()->where(['id' => $id_user])->one();
        $id_tienda = $datos_user->tienda_id;

        $query = (new \yii\db\Query())
            ->select(["concat(tiendas.nombre, ' - ', tiendas.razon_social) as nombre_tienda", 'tiendas.codigo as codigo_tienda', 'productos.nombre as producto', "concat(existencias.cantidad, ' ', medidas.abv_med) as cantidad"])
            ->from('existencias')
            ->leftJoin('tiendas', 'existencias.tienda_id = tiendas.id')
            ->leftJoin('productos', 'existencias.producto_id = productos.id')
            ->leftJoin('medidas', 'productos.medida_id = medidas.id')
            ->where(['existencias.tienda_id' => $id_tienda])
            ->all();

		$file = \Yii::createObject([
		    'class' => 'codemix\excelexport\ExcelFile',
		    'sheets' => [
		        'Existencias' => [
		            'data' => $query,
		            'titles' => ['Tienda', 'Código de Tienda', 'Producto', 'Cantidad'],
		        ],
		    ]
		]);

		$file->send('rptExistencias.xlsx');
    } 

    public function actionRptStockMinimo() 
    {
        $id_user = Yii::$app->user->id;
        $datos_user = User::find()->where(['id' => $id_user])->one();
        $id_tienda = $datos_user->tienda_id;

        $query = (new \yii\db\Query())
            ->select(['p.nombre as producto', 'p.codigo', 'categorias.categoria', 'p.stock_minimo', 'existencias.cantidad'])
            ->from('existencias')
            ->leftJoin('productos as p', 'existencias.producto_id = p.id')
            ->leftJoin('categorias', 'p.categoria_id = categorias.id')
            ->leftJoin('medidas', 'p.medida_id = medidas.id')
            ->where(['<=', 'existencias.cantidad', 'p.stock_minimo'])
            ->andWhere(['existencias.tienda_id' => $id_tienda])
            ->all();          

        var_dump($query); die();

        $file = \Yii::createObject([
            'class' => 'codemix\excelexport\ExcelFile',
            'sheets' => [
                'Stock' => [
                    'data' => $query,
                    'titles' => ['Nombre del Producto', 'Código', 'Categoria', 'Stock Mínimo', 'Cantidad en Existencia'],
                ],
            ]
        ]);

        $file->send('rptStockMinimo.xlsx');
    } 

    public function actionRptLibroPrecios() 
    {
        $id_user = Yii::$app->user->id;
        $datos_user = User::find()->where(['id' => $id_user])->one();
        $id_tienda = $datos_user->tienda_id;

        $query = (new \yii\db\Query())
            ->select(['libro_precios.descripcion', 'tiendas.nombre as tienda', 'libro_precios.fecha_inicio', 'libro_precios.fecha_fin', 'productos.nombre as producto', 'libro_precios_productos.precio'])
            ->from('libro_precios_productos')
            ->leftJoin('libro_precios', 'libro_precios_productos.libro_precio_id = libro_precios.id')
            ->leftJoin('productos', 'libro_precios_productos.producto_id = productos.id')
            ->leftJoin('tiendas', 'libro_precios.tienda_id = tiendas.id')
            ->where(['libro_precios.tienda_id' => $id_tienda])
            ->all();          

        $file = \Yii::createObject([
            'class' => 'codemix\excelexport\ExcelFile',
            'sheets' => [
                'LibroPrecios' => [
                    'data' => $query,
                    'titles' => ['Descripción', 'Tienda', 'Fecha de Inicio', 'Fecha Fin', 'Nombre del Producto', 'Precio'],
                ],
            ]
        ]);

        $file->send('rptLibroPrecios.xlsx');
    } 

    public function actionRptOrdenesCompra() 
    {
        $query = (new \yii\db\Query())
            ->select(['orden_compra.nro_documento', 'orden_compra.fecha', 'proveedores.nombre as proveedor', 'productos.nombre as producto', 'orden_productos.cantidad', 'orden_productos.precio_compra', 'orden_productos.precio_venta', 'orden_productos.utilidad'])
            ->from('orden_productos')
            ->leftJoin('orden_compra', 'orden_productos.orden_compra_id = orden_compra.id')
            ->leftJoin('proveedores', 'orden_compra.proveedor_id = proveedores.id')
            ->leftJoin('productos', 'orden_productos.producto_id = productos.id')
            ->where(['orden_compra.status' => 1])
            ->all();          

        $file = \Yii::createObject([
            'class' => 'codemix\excelexport\ExcelFile',
            'sheets' => [
                'OrdenesCompra' => [
                    'data' => $query,
                    'titles' => ['N° Orden', 'Fecha', 'Nombre del Proveedor', 'Descripción del Producto', 'Cantidad', 'Precio de Compra', 'Precio de Venta', 'Utilidad'],
                ],
            ]
        ]);

        $file->send('rptOrdenesCompra.xlsx');
    }                        

    public function actionRptBancos() 
    {
        $query = (new \yii\db\Query())
            ->select(['banco_operador.nombre_banco', 'banco_operador.descripcion as descripcion_banco', 'bancos.nro_cuenta', 'bancos.descripcion_cuenta', 'bancos.saldo_disponible'])
            ->from('bancos')
            ->leftJoin('banco_operador', 'bancos.banco_operador_id = banco_operador.id ')
            ->where(['bancos.status' => '1'])
            ->all();          

		$file = \Yii::createObject([
		    'class' => 'codemix\excelexport\ExcelFile',
		    'sheets' => [

		        'Bancos' => [
		            'data' => $query,
		            'titles' => ['Nombre del Banco', 'Descripción del Banco', 'N° de Cuenta', 'Descripción de la Cuenta', 'Saldo Disponible'],
		        ],
		    ]
		]);

		$file->send('rptBancos.xlsx');
    }      

    public function actionRptMovBancarios() 
    {
        $query = (new \yii\db\Query())
            ->select(['banco_operador.nombre_banco', 'bancos.nro_cuenta', 'mov_bancario_tipo.tipo_movimiento', 'mov_bancarios.nro_referencia', 'mov_bancarios.valor', 'mov_bancarios.observacion', 'mov_bancarios.nota_impresion'])
            ->from('mov_bancarios')
            ->leftJoin('bancos', 'mov_bancarios.banco_id = bancos.id')
            ->leftJoin('banco_operador', 'bancos.banco_operador_id = banco_operador.id')
            ->leftJoin('mov_bancario_tipo', 'mov_bancarios.tipo_movimiento_id = mov_bancario_tipo.id')
            ->where(['mov_bancarios.status' => '1'])
            ->all();                   

		$file = \Yii::createObject([
		    'class' => 'codemix\excelexport\ExcelFile',
		    'sheets' => [

		        'MovBancarios' => [
		            'data' => $query,
		            'titles' => ['Nombre del Banco', 'N° de Cuenta', 'Tipo de Movimiento', 'N° de Referencia', 'Monto', 'Observación', 'Nota de Impresión'],
		        ],
		    ]
		]);

		$file->send('rptMovBancarios.xlsx');
    }

    public function actionRptMovMercancia() 
    {
        $id_user = Yii::$app->user->id;
        $datos_user = User::find()->where(['id' => $id_user])->one();
        $id_tienda = $datos_user->tienda_id;

        $query = (new \yii\db\Query())
            ->select(['inventario.nro_documento', 'inventario.tipo_movimiento', 'inventario.fecha', 'orden_compra.nro_documento as nro_orden_compra', 'proveedores.razon_social', 'productos.nombre', "concat(orden_productos.cantidad, ' ', medidas.abv_med) as cantidad"])
            ->from('inventario')
            ->leftJoin('orden_compra', 'inventario.orden_compra_id = orden_compra.id')
            ->leftJoin('orden_productos', 'inventario.orden_compra_id = orden_productos.orden_compra_id')
            ->leftJoin('productos', 'orden_productos.producto_id = productos.id')
            ->leftJoin('medidas', 'productos.medida_id = medidas.id')
            ->leftJoin('proveedores', 'orden_compra.proveedor_id = proveedores.id')
            ->where(['inventario.status' => '1'])
            ->andWhere(['inventario.tienda_id' => $id_tienda])
            ->orderBy(['inventario.nro_documento' => SORT_ASC])
            ->all();                   

        $file = \Yii::createObject([
            'class' => 'codemix\excelexport\ExcelFile',
            'sheets' => [

                'MovimientoMercancia' => [
                    'data' => $query,
                    'titles' => ['N° de Documento', 'Tipo de Movimiento', 'Fecha', 'N° de Orden de Compra', 'Nombre del Proveedor', 'Descripción del Producto', 'Cantidad'],
                ],
            ]
        ]);

        $file->send('rptMovMercancia.xlsx');
    } 

    public function actionRptAudInventario() 
    {
        $id_user = Yii::$app->user->id;
        $datos_user = User::find()->where(['id' => $id_user])->one();
        $id_tienda = $datos_user->tienda_id;

        $query = (new \yii\db\Query())
            ->select(['inventario_auditoria.descripcion', 'inventario_auditoria.fecha', 'productos.nombre', "concat(inventario_auditoria_productos.cantidad, ' ', medidas.abv_med) as cantidad", "concat(inventario_auditoria_productos.cantidad_final, ' ', medidas.abv_med) as cantidad_final", 'inventario_auditoria_productos.observacion'])
            ->from('inventario_auditoria')
            ->leftJoin('inventario_auditoria_productos', 'inventario_auditoria.id = inventario_auditoria_productos.inventario_auditoria_id')
            ->leftJoin('productos', 'inventario_auditoria_productos.producto_id = productos.id')
            ->leftJoin('medidas', 'productos.medida_id = medidas.id')
            ->where(['inventario_auditoria.status' => '1'])
            ->andWhere(['inventario_auditoria.tienda_id' => $id_tienda])
            ->all();                   

        $file = \Yii::createObject([
            'class' => 'codemix\excelexport\ExcelFile',
            'sheets' => [

                'Auditorias' => [
                    'data' => $query,
                    'titles' => ['Descripción de Auditoria', 'Fecha', 'Descripción del Producto', 'Cantidad', 'Cantidad Final'],
                ],
            ]
        ]);

        $file->send('rptAudInventario.xlsx');
    }         

    public function actionRptSaldoClientes() 
    {
        $query = (new \yii\db\Query())
            ->select(['nombre', "concat(tipo_identificacion, ' : ', nro_identificacion) as num_identificacion", 'correo', 'telefono', 'movil', 'direccion', 'monto_credito'])
            ->from('clientes')
            ->where(['status' => '1'])
            ->andWhere(['credito' => '1'])
            ->all();                   

        $file = \Yii::createObject([
            'class' => 'codemix\excelexport\ExcelFile',
            'sheets' => [

                'SaldoClientes' => [
                    'data' => $query,
                    'titles' => ['Nombre del Cliente', 'N° de Identificación', 'Correo Electrónico', 'Teléfono', 'Móvil', 'Dirección', 'Crédito'],
                ],
            ]
        ]);

        $file->send('rptSaldoClientes.xlsx');
    }    

    public function actionFormGastos()
    {
        $id_user = Yii::$app->user->id;
        $datos_user = User::find()->where(['id' => $id_user])->one();
        $id_tienda = $datos_user->tienda_id;

        $buscaGC = GastosCategorias::find()->where(['status' => 1])->all();
        $categorias = ArrayHelper::map($buscaGC, 'id', 'categoria');

        if (Yii::$app->request->post()) {
            $categoria_id = $_POST['producto_id'];
            $mes = $_POST['mes'];
        
            if ((empty($categoria_id)) && (empty($mes))) {
                $query = (new \yii\db\Query())
                    ->select(['gastos.descripcion', 'gastos_subcategorias.subcategoria', 'gastos.fecha', 'proveedores.razon_social as proveedor', 'forma_pago.descripcion as forma_pago', 'gastos.monto', "concat(impuestos.valor, ' ', '%') as impuesto", 'bancos.nro_cuenta', 'banco_operador.nombre_banco', 'gastos.nro_referencia', 'gastos.nota'])
                    ->from('gastos')
                    ->leftJoin('proveedores', 'gastos.proveedor_id = proveedores.id')
                    ->leftJoin('forma_pago', 'gastos.forma_pago_id = forma_pago.id')
                    ->leftJoin('impuestos', 'gastos.impuesto_id = impuestos.id')
                    ->leftJoin('gastos_subcategorias', 'gastos.gastos_subcategorias_id = gastos_subcategorias.id')
                    ->leftJoin('bancos', 'gastos.banco_id = bancos.id')
                    ->leftJoin('banco_operador', 'bancos.banco_operador_id = banco_operador.id')
                    ->where(['gastos.tienda_id' => $id_tienda])
                    ->all();          

                $file = \Yii::createObject([
                    'class' => 'codemix\excelexport\ExcelFile',
                    'sheets' => [
                        'Gastos' => [
                            'data' => $query,
                            'titles' => ['Descripción del Gasto', 'Subcategoria', 'Fecha', 'Nombre del Proveedor', 'Forma de Pago', 'Monto', 'Impuesto', 'Nº de Cuenta', 'Banco', 'Nº de Referencia', 'Nota'],
                        ],
                    ]
                ]);

                $file->send('rptGastos.xlsx');                
            }
            if ((!empty($categoria_id)) && (empty($mes))) {
                $query = (new \yii\db\Query())
                    ->select(['gastos.descripcion', 'gastos_subcategorias.subcategoria', 'gastos.fecha', 'proveedores.razon_social as proveedor', 'forma_pago.descripcion as forma_pago', 'gastos.monto', "concat(impuestos.valor, ' ', '%') as impuesto", 'bancos.nro_cuenta', 'banco_operador.nombre_banco', 'gastos.nro_referencia', 'gastos.nota'])
                    ->from('gastos')
                    ->leftJoin('proveedores', 'gastos.proveedor_id = proveedores.id')
                    ->leftJoin('forma_pago', 'gastos.forma_pago_id = forma_pago.id')
                    ->leftJoin('impuestos', 'gastos.impuesto_id = impuestos.id')
                    ->leftJoin('gastos_subcategorias', 'gastos.gastos_subcategorias_id = gastos_subcategorias.id')
                    ->leftJoin('bancos', 'gastos.banco_id = bancos.id')
                    ->leftJoin('banco_operador', 'bancos.banco_operador_id = banco_operador.id')
                    ->where(['gastos.tienda_id' => $id_tienda])
                    ->andWhere(['gastos.gastos_categorias_id' => $categoria_id])
                    ->all();          

                $file = \Yii::createObject([
                    'class' => 'codemix\excelexport\ExcelFile',
                    'sheets' => [
                        'Gastos' => [
                            'data' => $query,
                            'titles' => ['Descripción del Gasto', 'Subcategoria', 'Fecha', 'Nombre del Proveedor', 'Forma de Pago', 'Monto', 'Impuesto', 'Nº de Cuenta', 'Banco', 'Nº de Referencia', 'Nota'],
                        ],
                    ]
                ]);

                $file->send('rptGastos.xlsx'); 
            }
            if ((empty($categoria_id)) && (!empty($mes))) {
                $query = (new \yii\db\Query())
                    ->select(['gastos.descripcion', 'gastos_subcategorias.subcategoria', 'gastos.fecha', 'proveedores.razon_social as proveedor', 'forma_pago.descripcion as forma_pago', 'gastos.monto', "concat(impuestos.valor, ' ', '%') as impuesto", 'bancos.nro_cuenta', 'banco_operador.nombre_banco', 'gastos.nro_referencia', 'gastos.nota'])
                    ->from('gastos')
                    ->leftJoin('proveedores', 'gastos.proveedor_id = proveedores.id')
                    ->leftJoin('forma_pago', 'gastos.forma_pago_id = forma_pago.id')
                    ->leftJoin('impuestos', 'gastos.impuesto_id = impuestos.id')
                    ->leftJoin('gastos_subcategorias', 'gastos.gastos_subcategorias_id = gastos_subcategorias.id')
                    ->leftJoin('bancos', 'gastos.banco_id = bancos.id')
                    ->leftJoin('banco_operador', 'bancos.banco_operador_id = banco_operador.id')
                    ->where(['gastos.tienda_id' => $id_tienda])
                    ->andWhere(['month(gastos.fecha)' => $mes])
                    ->all();          

                $file = \Yii::createObject([
                    'class' => 'codemix\excelexport\ExcelFile',
                    'sheets' => [
                        'Gastos' => [
                            'data' => $query,
                            'titles' => ['Descripción del Gasto', 'Subcategoria', 'Fecha', 'Nombre del Proveedor', 'Forma de Pago', 'Monto', 'Impuesto', 'Nº de Cuenta', 'Banco', 'Nº de Referencia', 'Nota'],
                        ],
                    ]
                ]);

                $file->send('rptGastos.xlsx'); 
            }
            if ((!empty($categoria_id)) && (!empty($mes))) {
                $query = (new \yii\db\Query())
                    ->select(['gastos.descripcion', 'gastos_subcategorias.subcategoria', 'gastos.fecha', 'proveedores.razon_social as proveedor', 'forma_pago.descripcion as forma_pago', 'gastos.monto', "concat(impuestos.valor, ' ', '%') as impuesto", 'bancos.nro_cuenta', 'banco_operador.nombre_banco', 'gastos.nro_referencia', 'gastos.nota'])
                    ->from('gastos')
                    ->leftJoin('proveedores', 'gastos.proveedor_id = proveedores.id')
                    ->leftJoin('forma_pago', 'gastos.forma_pago_id = forma_pago.id')
                    ->leftJoin('impuestos', 'gastos.impuesto_id = impuestos.id')
                    ->leftJoin('gastos_subcategorias', 'gastos.gastos_subcategorias_id = gastos_subcategorias.id')
                    ->leftJoin('bancos', 'gastos.banco_id = bancos.id')
                    ->leftJoin('banco_operador', 'bancos.banco_operador_id = banco_operador.id')
                    ->where(['gastos.tienda_id' => $id_tienda])
                    ->andWhere(['gastos.gastos_categorias_id' => $categoria_id])
                    ->andWhere(['month(gastos.fecha)' => $mes])
                    ->all();          

                $file = \Yii::createObject([
                    'class' => 'codemix\excelexport\ExcelFile',
                    'sheets' => [
                        'Gastos' => [
                            'data' => $query,
                            'titles' => ['Descripción del Gasto', 'Subcategoria', 'Fecha', 'Nombre del Proveedor', 'Forma de Pago', 'Monto', 'Impuesto', 'Nº de Cuenta', 'Banco', 'Nº de Referencia', 'Nota'],
                        ],
                    ]
                ]);

                $file->send('rptGastos.xlsx'); 
            }                                     
        }    

        return $this->renderAjax('form-gastos', [
            'categorias' => $categorias,
        ]);
    }    
}
