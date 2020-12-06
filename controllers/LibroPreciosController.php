<?php

namespace app\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use app\models\Tiendas;
use app\models\LibroPrecios;
use app\models\LibroPreciosForm;
use app\models\search\LibroPrecioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LibroPreciosController implements the CRUD actions for LibroPrecios model.
 */
class LibroPreciosController extends Controller
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
     * Lists all LibroPrecios models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new LibroPreciosForm();

        $model->libroPrecios = new LibroPrecios;

        $model->libroPrecios->loadDefaultValues();
        $model->setAttributes(Yii::$app->request->post());        

        $libroPreciosForm=Yii::$app->request->post('LibroPreciosForm');

        $buscaT = Tiendas::find()->where(['status' => 1])->all();
        $tiendas = ArrayHelper::map($buscaT, 'id', 'nombre');         
        
        $searchModel = new LibroPrecioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->setPagination(['pageSize' => 10]);

        if (Yii::$app->request->post()) {
            $fecha_ini = date('Y-m-d', strtotime($model->libroPrecios->fecha_inicio));
            $model->libroPrecios->fecha_inicio = $fecha_ini;

            $fecha_fin = date('Y-m-d', strtotime($model->libroPrecios->fecha_fin));
            $model->libroPrecios->fecha_fin = $fecha_fin;            

            $model->save();
            Yii::$app->session->setFlash('success', 'El Libro de Precios fué creado de manera exitosa.');
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
     * Displays a single LibroPrecios model.
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
     * Creates a new LibroPrecios model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new LibroPrecios();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing LibroPrecios model.
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
     * Deletes an existing LibroPrecios model.
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
     * Finds the LibroPrecios model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return LibroPrecios the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LibroPrecios::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
