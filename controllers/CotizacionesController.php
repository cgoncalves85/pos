<?php

namespace app\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use app\models\User;
use app\models\Tiendas;
use app\models\Cotizaciones;
use app\models\Clientes;
use app\models\CotizacionesForm;
use app\models\CotizacionesProductos;
use app\models\search\CotizacionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;

/**
 * CotizacionesController implements the CRUD actions for Cotizaciones model.
 */
class CotizacionesController extends Controller
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


    public function actionImprimirPdf($id) {

        $user_id = Yii::$app->user->id;
        $datos_usuario = User::find()->where(['id' => $user_id])->one();
        $id_tienda = $datos_usuario->tienda_id;
        $tienda = Tiendas::find()->where(['id' => $id_tienda])->one();

        $productos = CotizacionesProductos::find()->where(['cotizaciones_id' => $id])->all();

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
     * Lists all Cotizaciones models.
     * @return mixed
     */
    public function actionIndex()
    {

        $model = new CotizacionesForm();

        $model->cotizaciones = new Cotizaciones;
        $model->cotizaciones->fecha = date('d-m-Y');

        $model->cotizaciones->loadDefaultValues();
        $model->setAttributes(Yii::$app->request->post());        

        $cotizacionesForm=Yii::$app->request->post('CotizacionesForm');  

        $buscaC = Clientes::find()->where(['status' => 1])->all();
        $clientes = ArrayHelper::map($buscaC, 'id', 'nombre');                         

        $searchModel = new CotizacionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->setPagination(['pageSize' => 10]);

        if (Yii::$app->request->post()) {
            $productos = $model->productos;

            $total = 0;
            foreach ($productos as $prod) {
                $total = $total + $prod->precio;
            }

            $model->cotizaciones->precio_total = $total;
            $fecha = date('Y-m-d', strtotime($model->cotizaciones->fecha));
            $model->cotizaciones->fecha = $fecha;
            $model->save();
            Yii::$app->session->setFlash('success', 'La Cotización fué generada de manera exitosa.');
            return $this->redirect(['index']);
        }

        return $this->render('index', [
            'model' => $model, 
            'clientes' => $clientes,          
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Cotizaciones model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $modelCP = CotizacionesProductos::find()->where(['cotizaciones_id' => $id])->all(); 
        /*
        for ($i=0; $i < count($modelCP); $i++) {
            $porc_imp = ($modelCP[$i]->producto->impuesto->valor / 100) + 1;
            $precio = $modelCP[$i]->precio_unitario / $porc_imp; //454.55
            $importe = $modelCP[$i]->cantidad * $precio; //4545.5
            $monto_imp = $modelCP[$i]->precio - $importe; //454.55
            $subtotal = ($modelCP[$i]->cantidad * $modelCP[$i]->precio) - $importe;        

            var_dump($subtotal); die();
        }
        */

        return $this->render('view', [
            'model' => $this->findModel($id),
            'modelCP' => $modelCP,
        ]);
    }

    /**
     * Creates a new Cotizaciones model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Cotizaciones();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Cotizaciones model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    { 
        $model = new CotizacionesForm();
        $model->cotizaciones = $this->findModel($id);

        $CP = count(CotizacionesProductos::find()->where(['cotizaciones_id' => $id])->all());      

        $model->cotizaciones->fecha = date('d-m-Y', strtotime($model->cotizaciones->fecha));
        
        $cotizacionesForm=Yii::$app->request->post('CotizacionesForm');
        $model->setAttributes(Yii::$app->request->post());

        $buscaC = Clientes::find()->where(['status' => 1])->all();
        $clientes = ArrayHelper::map($buscaC, 'id', 'nombre');

        if (Yii::$app->request->post()) {
            $productos = $model->productos;

            $total = 0;
            foreach ($productos as $prod) {
                $total = $total + $prod->precio;
            }

            $model->cotizaciones->precio_total = $total;                   
            $fecha = date('Y-m-d', strtotime($model->cotizaciones->fecha));
            $model->cotizaciones->fecha = $fecha;
            $model->save();
            Yii::$app->session->setFlash('success', 'La Cotización ha sido actualizada de manera exitosa.');
            return $this->redirect(['index']);            
        }
        return $this->render('update', [
            'model' => $model,
            'clientes' => $clientes,
        ]);
    }

    /**
     * Deletes an existing Cotizaciones model.
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

    /**
     * Finds the Cotizaciones model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cotizaciones the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cotizaciones::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
