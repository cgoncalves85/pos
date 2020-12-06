<?php

namespace app\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use app\models\Inventario;
use app\models\Existencias;
use app\models\Tiendas;
use app\models\OrdenCompra;
use app\models\OrdenProductos;
use app\models\InventarioForm;
use app\models\InventarioProductos;
use app\models\User;
use app\models\search\InventarioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * InventarioController implements the CRUD actions for Inventario model.
 */
class InventarioController extends Controller
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

    /**
     * Lists all Inventario models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InventarioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Inventario models.
     * @return mixed
     */
    public function actionIngreso()
    {
        $id_user = Yii::$app->user->id;
        $datos = User::find()->where(['id' => $id_user])->one();
        $id_tienda = $datos->tienda_id;        

        $model = new Inventario();

        $buscaT = Tiendas::find()->where(['status' => 1])->all();
        $tiendas = ArrayHelper::map($buscaT, 'id', 'nombre'); 

        $buscaOC = OrdenCompra::find()->where(['status' => 1])->all();
        $ordenes = ArrayHelper::map($buscaOC, 'id', 'nro_documento');         

        $searchModel = new InventarioSearch();
        $dataProvider = $searchModel->searchi(Yii::$app->request->queryParams);
        $dataProvider->setPagination(['pageSize' => 10]);

        if ($model->load(Yii::$app->request->post())) {
            $model->tienda_id = $id_tienda;
            $model->tienda_origen_id = NULL;
            $model->tienda_destino_id = NULL;

            $fecha = date('Y-m-d', strtotime($model->fecha));
            $model->fecha = $fecha;

            $model->save();

            $oc = $model->orden_compra_id;

            $buscaProductos = OrdenProductos::find()->where(['orden_compra_id' => $oc])->all();

            for ($i=0; $i <count($buscaProductos) ; $i++) {
                $modelIP = new InventarioProductos();
                $modelIP->inventario_id = $model->id;
                $modelIP->producto_id = $buscaProductos[$i]->producto_id;
                $modelIP->cantidad = $buscaProductos[$i]->cantidad;
                $modelIP->save();

                $buscaEx = Existencias::find()->where(['tienda_id' => $model->tienda_id])->andWhere(['producto_id' => $buscaProductos[$i]->producto_id])->one();

                if ($buscaEx == NULL) {
                    $modelEx = new Existencias();
                    $modelEx->tienda_id = $model->tienda_id;
                    $modelEx->producto_id = $buscaProductos[$i]->producto_id;
                    $modelEx->cantidad = $buscaProductos[$i]->cantidad;
                    $modelEx->save();
                } else {

                    $cantExistente = $buscaEx->cantidad;
                    $buscaEx->cantidad = $cantExistente + $buscaProductos[$i]->cantidad;
                    $buscaEx->save();
                }

            }

            return $this->redirect(['ingreso']);
        }

        return $this->render('index-ingreso', [
            'model' => $model,
            'tiendas' => $tiendas,
            'ordenes' => $ordenes,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    } 

    /**
     * Lists all Inventario models.
     * @return mixed
     */
    public function actionEgreso()
    {
        $id_user = Yii::$app->user->id;
        $datos = User::find()->where(['id' => $id_user])->one();
        $id_tienda = $datos->tienda_id;

        $model = new InventarioForm();  

        $model->inventario = new Inventario;

        $model->inventario->loadDefaultValues();
        $model->setAttributes(Yii::$app->request->post());        

        $inventarioForm=Yii::$app->request->post('InventarioForm');

        $buscaT = Tiendas::find()->where(['status' => 1])->all();
        $tiendas = ArrayHelper::map($buscaT, 'id', 'nombre');       

        $searchModel = new InventarioSearch();
        $dataProvider = $searchModel->searche(Yii::$app->request->queryParams);
        $dataProvider->setPagination(['pageSize' => 10]);

        if ($model->load(Yii::$app->request->post())) {

            $model->inventario->tienda_id = $id_tienda;
            $model->inventario->orden_compra_id = NULL;
            $model->inventario->tienda_origen_id = NULL;
            $model->inventario->tienda_destino_id = NULL;

            $fecha = date('Y-m-d', strtotime($model->inventario->fecha));
            $model->inventario->fecha = $fecha;

            $model->save();

            $buscaProductos = InventarioProductos::find()->where(['inventario_id' => $model->inventario->id])->all();

            for ($i=0; $i <count($buscaProductos) ; $i++) { 
                $buscaEx = Existencias::find()->where(['tienda_id' => $model->inventario->tienda_id])->andWhere(['producto_id' => $buscaProductos[$i]->producto_id])->one();
                if ($buscaEx == NULL) {
                    $modelEx = new Existencias();
                    $modelEx->tienda_id = $model->tienda_id;
                    $modelEx->producto_id = $buscaProductos[$i]->producto_id;
                    $modelEx->cantidad = -$buscaProductos[$i]->cantidad;
                    $modelEx->save();
                } else {

                    $cantExistente = $buscaEx->cantidad;
                    $buscaEx->cantidad = $cantExistente - $buscaProductos[$i]->cantidad;
                    $buscaEx->save();
                }                

            }

            return $this->redirect(['egreso']);
        }

        return $this->render('index-egreso', [
            'model' => $model,
            'tiendas' => $tiendas,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }        

    /**
     * Displays a single Inventario model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Inventario model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Inventario();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Inventario model.
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
     * Deletes an existing Inventario model.
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
     * Finds the Inventario model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Inventario the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Inventario::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
