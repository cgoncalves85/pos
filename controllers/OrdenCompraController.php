<?php

namespace app\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use app\models\OrdenCompra;
use app\models\OrdenCompraForm;
use app\models\OrdenProductos;
use app\models\Proveedores;
use app\models\Productos;
use app\models\search\OrdenCompraSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrdenCompraController implements the CRUD actions for OrdenCompra model.
 */
class OrdenCompraController extends Controller
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
     * Lists all OrdenCompra models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new OrdenCompraForm();  

        $model->ordenCompra = new OrdenCompra;

        $model->ordenCompra->loadDefaultValues();
        $model->setAttributes(Yii::$app->request->post());        

        $ordenForm=Yii::$app->request->post('OrdenCompraForm');

        $buscaP = Proveedores::find()->where(['status' => 1])->all();
        $proveedores = ArrayHelper::map($buscaP, 'id', 'nombre');                  

        $searchModel = new OrdenCompraSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->setPagination(['pageSize' => 10]);

        if (Yii::$app->request->post()) {

            $fecha = date('Y-m-d', strtotime($model->ordenCompra->fecha));
            $model->ordenCompra->fecha = $fecha;
            $model->save();
            return $this->redirect(['index']);
        }

        return $this->render('index', [
            'model' => $model,
            'proveedores' => $proveedores,            
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single OrdenCompra model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $modelOP = OrdenProductos::find()->where(['orden_compra_id' => $id])->all(); 

        $costo_total = 0;
        for ($i=0; $i < count($modelOP) ; $i++) { 
            $costo_total = $costo_total + $modelOP[$i]->precio_compra;
        }

        return $this->render('view', [
            'model' => $this->findModel($id),
            'modelOP' => $modelOP,
            'costo_total' => $costo_total,
        ]);
    }

    /**
     * Creates a new OrdenCompra model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new OrdenCompraForm();  

        $model->ordenCompra = new OrdenCompra;

        $model->ordenCompra->loadDefaultValues();
        $model->setAttributes(Yii::$app->request->post());        

        $ordenForm=Yii::$app->request->post('OrdenCompraForm');

        $buscaP = Proveedores::find()->where(['status' => 1])->all();
        $proveedores = ArrayHelper::map($buscaP, 'id', 'nombre');          

        if (Yii::$app->request->post() && $model->save()) {
            return $this->redirect(['view', 'id' => $model->ordenCompra->id]);
        }
        return $this->render('create', [
            'model' => $model,
            'proveedores' => $proveedores,
        ]);
    }

    /**
     * Updates an existing OrdenCompra model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = new OrdenCompraForm();
        $model->ordenCompra = $this->findModel($id);

        $model->ordenCompra->fecha = date('d-m-Y', strtotime($model->ordenCompra->fecha));
        
        $ordenForm=Yii::$app->request->post('OrdenCompraForm');
        $model->setAttributes(Yii::$app->request->post());

        $buscaP = Proveedores::find()->where(['status' => 1])->all();
        $proveedores = ArrayHelper::map($buscaP, 'id', 'nombre');

        if (Yii::$app->request->post()) {
            $fecha = date('Y-m-d', strtotime($model->ordenCompra->fecha));
            $model->ordenCompra->fecha = $fecha;
            $model->save();
            return $this->redirect(['index']);
        }
        return $this->render('update', [
            'model' => $model,
            'proveedores' => $proveedores,
        ]);
    }

    /**
     * Deletes an existing OrdenCompra model.
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
     * Finds the OrdenCompra model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return OrdenCompra the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OrdenCompra::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
