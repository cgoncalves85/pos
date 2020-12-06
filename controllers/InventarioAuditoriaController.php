<?php

namespace app\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use app\models\InventarioAuditoria;
use app\models\InventarioAuditoriaProductos;
use app\models\search\InventarioAuditoriaSearch;
use app\models\InventarioAuditoriaForm;
use app\models\Tiendas;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * InventarioAuditoriaController implements the CRUD actions for InventarioAuditoria model.
 */
class InventarioAuditoriaController extends Controller
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
     * Lists all InventarioAuditoria models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new InventarioAuditoriaForm();  

        $model->inventarioAuditoria = new InventarioAuditoria;

        $model->inventarioAuditoria->loadDefaultValues();
        $model->setAttributes(Yii::$app->request->post());        

        $InventariosAuditoriaForm=Yii::$app->request->post('InventarioAuditoriaForm');

        $buscaT = Tiendas::find()->where(['status' => 1])->all();
        $tiendas = ArrayHelper::map($buscaT, 'id', 'nombre');                  

        $searchModel = new InventarioAuditoriaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->setPagination(['pageSize' => 10]);

        if (Yii::$app->request->post()) {

            $fecha = date('Y-m-d', strtotime($model->inventarioAuditoria->fecha));
            $model->inventarioAuditoria->fecha = $fecha;
            $model->save();
            return $this->redirect(['index']);
        }

        return $this->render('index', [
            'model' => $model,
            'tiendas' => $tiendas,            
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single InventarioAuditoria model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $modelIAP = InventarioAuditoriaProductos::find()->where(['inventario_auditoria_id' => $id])->all(); 

        return $this->render('view', [
            'model' => $this->findModel($id),
            'modelIAP' => $modelIAP,          
        ]);
    }

    /**
     * Creates a new InventarioAuditoria model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new InventarioAuditoria();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing InventarioAuditoria model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = new InventarioAuditoriaForm();  
        $model->inventarioAuditoria = $this->findModel($id);

        $model->inventarioAuditoria->fecha = date('d-m-Y', strtotime($model->inventarioAuditoria->fecha));        

        $InventariosAuditoriaForm=Yii::$app->request->post('InventarioAuditoriaForm');
        $model->setAttributes(Yii::$app->request->post());

        $buscaT = Tiendas::find()->where(['status' => 1])->all();
        $tiendas = ArrayHelper::map($buscaT, 'id', 'nombre');                  

        if (Yii::$app->request->post()) {
            $fecha = date('Y-m-d', strtotime($model->inventarioAuditoria->fecha));
            $model->inventarioAuditoria->fecha = $fecha;
            $model->save();
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
            'tiendas' => $tiendas,
        ]);
    }

    /**
     * Deletes an existing InventarioAuditoria model.
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
     * Finds the InventarioAuditoria model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return InventarioAuditoria the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = InventarioAuditoria::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
