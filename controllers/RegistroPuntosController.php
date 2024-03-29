<?php

namespace app\controllers;

use Yii;
use app\models\RegistroPuntos;
use app\models\search\RegistroPuntoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RegistroPuntosController implements the CRUD actions for RegistroPuntos model.
 */
class RegistroPuntosController extends Controller
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
     * Lists all RegistroPuntos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new RegistroPuntos();
        $model->status = 1;

        $searchModel = new RegistroPuntoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->setPagination(['pageSize' => 10]);

        if ($model->load(Yii::$app->request->post())) {

            $model->observacion = 'Por cada $ '.Yii::$app->formatter->asDecimal($model->valor).' en compras el cliente recibirá '.Yii::$app->formatter->asInteger($model->cantidad_puntos).' puntos.';
            $model->save();

            Yii::$app->session->setFlash('success', 'El Registro de Puntos fué creado de manera exitosa.');
            return $this->redirect(['index']); 
        }        

        return $this->render('index', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RegistroPuntos model.
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
     * Creates a new RegistroPuntos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RegistroPuntos();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing RegistroPuntos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $model->observacion = 'Por cada $ '.Yii::$app->formatter->asDecimal($model->valor).' en compras el cliente recibirá '.Yii::$app->formatter->asInteger($model->cantidad_puntos).' puntos.';
            $model->save();

            Yii::$app->session->setFlash('success', 'El Registro de Puntos fué modificado de manera exitosa.');
            return $this->redirect(['index']); 
        }

        return $this->renderAjax('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing RegistroPuntos model.
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
     * Finds the RegistroPuntos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RegistroPuntos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RegistroPuntos::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
