<?php

namespace app\controllers;

use Yii;
use app\models\Bonos;
use app\models\search\BonoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BonosController implements the CRUD actions for Bonos model.
 */
class BonosController extends Controller
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
     * Lists all Bonos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new Bonos();

        $model->status = 1;

        $searchModel = new BonoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->setPagination(['pageSize' => 10]);

        if ($model->load(Yii::$app->request->post())) {            
            if ($model->porcentaje_dcto == NULL) {
                if ($model->observacion == NULL) {
                    $model->observacion  = 'Premio - '.$model->premio;
                }            
                $model->porcentaje_dcto  = 0;
            } else {
                $model->observacion  = 'Descuento de '.$model->porcentaje_dcto.' % sobre el total de la compra';
            }
            $model->save();

            Yii::$app->session->setFlash('success', 'El Bono fué creado de manera exitosa.');
            return $this->redirect(['index']); 
        }        

        return $this->render('index', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Bonos model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Bonos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Bonos();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Bonos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->tipo_bono == 1) {
                if ($model->observacion == NULL) {
                    $model->observacion  = 'Descuento de '.$model->porcentaje_dcto.' % sobre el total de la compra';
                }            
                $model->premio  = '';
            }           
            if ($model->tipo_bono == 2) {
                if ($model->observacion == NULL) {
                    $model->observacion  = 'Premio - '.$model->premio;
                }            
                $model->porcentaje_dcto  = 0;
            }
            $model->save();            
            
            Yii::$app->session->setFlash('success', 'El Bono fué modificado de manera exitosa.');
            return $this->redirect(['index']); 
        }

        return $this->renderAjax('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Bonos model.
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
     * Finds the Bonos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Bonos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Bonos::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionAplicarBono()
    {
        if (Yii::$app->request->isAjax) {

            $data = Yii::$app->request->post();
            $id = $data['id'];

            $buscaBono = Bonos::find()->where(['id' => $id])->one();
            $descripcion = $buscaBono->observacion;
            $tipo_bono = $buscaBono->tipo_bono;
            $puntos = $buscaBono->cantidad_puntos;

            if ($tipo_bono == 1) {
                $bono = $buscaBono->porcentaje_dcto;
            }

            if ($tipo_bono == 2) {
                $bono = $buscaBono->premio;
            }

            $datos = array('puntos' => $puntos, 'descripcion' => $descripcion, 'tipo_bono' => $tipo_bono, 'bono' => $bono);

            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            return ['datos' => $datos];
        }
    }    

}
