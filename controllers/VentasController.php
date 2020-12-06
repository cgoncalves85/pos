<?php

namespace app\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use app\models\Ventas;
use app\models\Bonos;
use app\models\User;
use app\models\Cajas;
use app\models\CajasApertura;
use app\models\Clientes;
use app\models\Tiendas;
use app\models\Categorias;
use app\models\Existencias;
use app\models\Productos;
use app\models\RegistroPuntos;
use app\models\VentasProductos;
use app\models\FormaPago;
use app\models\search\ExistenciaSearch;
use app\models\search\VentaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;

/**
 * VentasController implements the CRUD actions for Ventas model.
 */
class VentasController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionVender()
    {
        $id = Yii::$app->user->id;
        $fecha = date('Y-m-d');

        $datos_user = User::find()->where(['id' => $id])->one();
        $id_tienda = $datos_user->tienda_id;

        $buscaApertura = CajasApertura::find()->where(['user_id' => $id])->andWhere(['status' => 1])->one();


        if ($buscaApertura == NULL) {

            $model = new CajasApertura();

            $buscaCajas = Cajas::find()->where(['status' => 1])->andWhere(['tienda_id' => $id_tienda])->all();
            $cajas = ArrayHelper::map($buscaCajas, 'id', 'descripcion');             


            if ($model->load(Yii::$app->request->post()) ) {

                $caja_id = $model->caja_id;

                //var_dump($fecha); die();
                $buscaC = CajasApertura::find()->where(['caja_id' => $caja_id])->andWhere(['status' => 2])->andWhere(['fecha' => $fecha])->all();

                if (count($buscaC) == 0) {

                    $fecha = date('Y-m-d', strtotime($model->fecha));
                    $model->user_id = $id;
                    $model->fecha = $fecha;

                    $model->status = 1;
                    $model->save();

                    Yii::$app->session->setFlash('success', 'Bienvenidos ! La Caja se abrió de manera exitosa.');
                    return $this->redirect(['vender']);
                } else {
                    Yii::$app->session->setFlash('info', 'La Caja ya tiene el Cierre Diario. Intente abrir una Caja Disponible');
                    return $this->redirect(['vender']);                    
                }
            }
            
            return $this->render('apertura', [
                'model' => $model,
                'cajas' => $cajas,
            ]);

        } else {
            $model = new Ventas();

            $productos = Existencias::find()->where(['tienda_id' => $id_tienda])->all();

            $id_caja = $buscaApertura->caja_id;

            $buscaClientes = Clientes::find()->where(['status' => 1])->all();

            for ($i=0; $i < count($buscaClientes) ; $i++) { 
                $campos[$i] = array('id' => $buscaClientes[$i]->id, 'dato' => $buscaClientes[$i]->nro_identificacion.' / '.$buscaClientes[$i]->nombre);
            }
            $clientes = ArrayHelper::map($campos, 'id', 'dato'); 

            $buscaMetodoPago = FormaPago::find()->where(['status' => 1])->andWhere(['<>','id', 3])->all();
            $metodos_pago = ArrayHelper::map($buscaMetodoPago, 'id', 'descripcion');            

            $buscaProductos = Productos::find()->where(['status' => 1])->all();
            $listaP = ArrayHelper::map($buscaProductos, 'id', 'nombre');             

            $categorias = Categorias::find()->where(['status' => 1])->all(); 

            if ($model->load(Yii::$app->request->post()) ) {

                // Buscar Ventas Anteriores para Obtener el Correlativo
                $ultimo_id = Ventas::find()->max('id');

                if ($ultimo_id == NULL) {
                    $nro_documento = 1;
                } else {
                    $buscaVenta = Ventas::find()->where(['id' => $ultimo_id])->one();
                    $documento_ant = $buscaVenta->nro_documento;
                    $nro_documento = $documento_ant + 1;
                }
                // Fin de Busqueda y se guarda el Correlativo en la Variable $nro_documento

                $cant_productos = $_POST['cant-productos'];

                $model->user_id = $id;
                $model->caja_id = $id_caja;
                $model->nro_documento = $nro_documento;
                $model->status = 1;
                $model->fecha = date('Y-m-d');

                $searchCli = Clientes::find()->where(['id' => $model->cliente_id])->one();
                $buscaPromo = RegistroPuntos::find()->where(['status' => 1])->all();

                if (count($buscaPromo) > 0) {
                    for ($i=0; $i < count($buscaPromo) ; $i++) { 
                        $valor = $buscaPromo[$i]->valor;
                        if ($model->total >= $valor) {
                            $searchCli->puntos = $searchCli->puntos + $buscaPromo[$i]->cantidad_puntos;
                            $searchCli->save();
                        }
                    }
                }                

                $model->save();


                for ($i=0; $i <$cant_productos ; $i++) {
                    $producto = $_POST['producto']; 
                    $cantidad = $_POST['cantidad']; 
                    $buscarP = Productos::find()->where(['nombre' => $producto[$i]])->one();

                    $modelVP = new VentasProductos();
                    $modelVP->venta_id = $model->id;
                    $modelVP->producto_id = $buscarP->id;
                    $modelVP->cantidad = $cantidad[$i];

                    $modelVP->save();

                    $buscarExis = Existencias::find()->where(['tienda_id' => $id_tienda])->andWhere(['producto_id' => $buscarP->id])->one();

                    $cantidadExis = $buscarExis->cantidad;

                    $nuevaCant = $cantidadExis - $cantidad[$i];

                    $buscarExis->cantidad = $nuevaCant;

                    $buscarExis->save();
                }

                return $this->redirect(['view', 'id' => $model->id]);
            }

            return $this->render('create', [
                'model' => $model,
                'clientes' => $clientes,
                'metodos_pago' => $metodos_pago,
                'listaP' => $listaP,
                'categorias' => $categorias,
                'productos' => $productos,
            ]);            
        }
    } 

    public function actionCerrarCaja() {
        $id = Yii::$app->user->id;

        $buscaCierre = CajasApertura::find()->where(['user_id' => $id])->andWhere(['status' => 1])->one();

        //var_dump($buscaCierre); die();

        if ($buscaCierre != NULL) {



                if ($buscaCierre->load(Yii::$app->request->post()) ) {

                    $monto_cierre = $buscaCierre->monto_cierre;

                    if ($monto_cierre < $buscaCierre->monto_apertura) {
                        Yii::$app->session->setFlash('error', 'El Monto de Cierre debe ser mayor o igual al Monto de Apertura.');
                        return $this->render('cierre', [
                            'buscaCierre' => $buscaCierre,
                        ]);                   
                    }

                    $buscaCierre->status = 0;

                    $buscaCierre->save();

                    Yii::$app->session->setFlash('success', 'La Caja ha sido cerrada de manera satisfactoria.');
                    return $this->redirect(['vender']);
                }

                return $this->render('cierre', [
                    'buscaCierre' => $buscaCierre,
                ]);
            
        } else {
            Yii::$app->session->setFlash('info', 'La Caja ya se encuentra Cerrada !!');
            return $this->redirect(['vender']);
        }

        //var_dump($buscarCaja); die();
    }

    public function actionCierraCaja() {
        $id = Yii::$app->user->id;

        $buscaCierre = CajasApertura::find()->where(['user_id' => $id])->andWhere(['status' => 1])->one();



        if ($buscaCierre != NULL) {
            if($buscaCierre->monto_cierre !=0 ) {
                if ($buscaCierre->load(Yii::$app->request->post()) ) {

                    $monto_cierre = $buscaCierre->monto_cierre;

                    if ($monto_cierre < $buscaCierre->monto_apertura) {
                        Yii::$app->session->setFlash('error', 'El Monto de Cierre debe ser mayor o igual al Monto de Apertura.');
                        return $this->render('cierre', [
                            'buscaCierre' => $buscaCierre,
                        ]);                   
                    }

                    $buscaCierre->status = 2;

                    $buscaCierre->save();

                    Yii::$app->session->setFlash('success', 'La Caja ha sido cerrada de manera satisfactoria.');
                    return $this->redirect(['vender']);
                }

                return $this->render('cierre', [
                    'buscaCierre' => $buscaCierre,
                ]);
            } else {
                Yii::$app->session->setFlash('info', 'La Caja debe ser Cerrada por el Cajero antes de realizar el Cierre Diario');
                return $this->redirect(['cerrar-caja']);
            }
            
        } else {
            $buscaCierre = CajasApertura::find()->where(['user_id' => $id])->andWhere(['status' => 0])->all();

            $cr = count($buscaCierre);

            //var_dump($cr); die();

            if ($cr > 0 ) {

                foreach ($buscaCierre as $dato) {
                    $dato->status = 2;
                    $dato->save();
                }
                Yii::$app->session->setFlash('success', 'La Caja ha sido cerrada de manera satisfactoria.');
                return $this->redirect(['vender']);
            } else {
                Yii::$app->session->setFlash('info', 'La Caja ya se encuentra Cerrada !!');
                return $this->redirect(['vender']);                
            }
        }

        //var_dump($buscarCaja); die();
    }    

    public function actionAgregar($id)
    {
        $id_user = Yii::$app->user->id;
        $datos = User::find()->where(['id' => $id_user])->one();
        $id_tienda = $datos->tienda_id;        

        $producto = Existencias::find()->where(['producto_id' => $id])->andWhere(['tienda_id' => $id_tienda])->one();

        return $this->renderAjax('agregar_producto', [
            'producto' => $producto,
        ]);
    } 

    public function actionImprimirPdf($id) {

        $venta = $this->findModel($id);
        $id_caja = $venta->caja_id;
        $caja = Cajas::find()->where(['id' => $id_caja])->one();
        $id_tienda = $caja->tienda_id;
        $tienda = Tiendas::find()->where(['id' => $id_tienda])->one();

        $productos = VentasProductos::find()->where(['venta_id' => $id])->all();

        $content = $this->renderPartial('_reportView',[
            'model' => $this->findModel($id),
            'productos' => $productos,
            'tienda' => $tienda,
        ]);  

        $pdf = new Pdf([
            'mode' => Pdf::MODE_CORE, 
            'format' => Pdf::FORMAT_A4, 
            'orientation' => Pdf::ORIENT_PORTRAIT, 
            'destination' => Pdf::DEST_BROWSER, 
            'content' => $content,  
            'cssFile' => '../web/css/reportes.css',
            'methods' => [ 
                'SetFooter'=>['{PAGENO}'],
            ]
        ]);
        
        return $pdf->render(); 
    }          

    /**
     * Lists all Ventas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VentaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->setPagination(['pageSize' => 10]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Ventas model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $productos = VentasProductos::find()->where(['venta_id' => $id])->all();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'productos' => $productos,
        ]);
    }

    /**
     * Creates a new Ventas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Ventas();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Ventas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Ventas model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    } 

    public function actionCreditos() 
    {
        if (Yii::$app->request->isAjax) {

            $data = Yii::$app->request->post();
            $id = $data['id'];
            $buscaCliente = Clientes::find()->where(['id' => $id])->one();
            $nombre = $buscaCliente->nombre;
            $monto = Yii::$app->formatter->asDecimal($buscaCliente->monto_credito);
            $puntos = $buscaCliente->puntos;
            
            if ($buscaCliente->credito == 0) {
                $mensaje = 'El Cliente '.$nombre.' No posee Crédito';
                $monto = 0;
            } else {
                $mensaje = 'El Cliente '.$nombre.' posee un Crédto por : ';
            }

            $datos = array('nombre' => $nombre, 'monto' => $monto, 'puntos' => $puntos, 'mensaje' => $mensaje);

            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            return ['datos' => $datos];
        }
    } 

    public function actionBonos($id) 
    {

        $listaBonos = Bonos::find()->where(['<=', 'cantidad_puntos', $id])->andWhere(['status' => 1])->all();
        return $this->renderAjax('bonos', [
            'listaBonos' => $listaBonos,
        ]);
        
    }         

    /**
     * Finds the Ventas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Ventas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Ventas::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
