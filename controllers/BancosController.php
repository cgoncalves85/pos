<?php

namespace app\controllers;

use Yii;
use app\models\Bancos;
use app\models\BancoOperador;
use yii\helpers\ArrayHelper;
use app\models\search\BancoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BancosController implements the CRUD actions for Bancos model.
 */
class BancosController extends Controller
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
     * Lists all Bancos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new Bancos();

        $buscaOp = BancoOperador::find()->where(['status' => 1])->all();
        $bancos = ArrayHelper::map($buscaOp, 'id', 'nombre_banco');         

        $searchModel = new BancoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->setPagination(['pageSize' => 10]);

        if ($model->load(Yii::$app->request->post()) ) {
            $model->saldo_disponible = $model->saldo_inicial;
            $model->save();
            Yii::$app->session->setFlash('success', 'La Cuenta Bancaria fué creada de manera exitosa.');
            return $this->redirect(['index']);            
        }        

        return $this->render('index', [
            'model' => $model,
            'bancos' => $bancos,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Bancos model.
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
     * Creates a new Bancos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Bancos();

        $buscaOp = BancoOperador::find()->where(['status' => 1])->all();
        $bancos = ArrayHelper::map($buscaOp, 'id', 'nombre_banco');

        if ($model->load(Yii::$app->request->post()) ) {
            $model->saldo_disponible = $model->saldo_inicial;
            $model->save();
            Yii::$app->session->setFlash('success', 'La Cuenta Bancaria fué creada de manera exitosa.');
            return $this->redirect(Yii::$app->request->referrer);           
        }

        return $this->renderAjax('create', [
            'model' => $model,
            'bancos' => $bancos,
        ]);
    }

    /**
     * Updates an existing Bancos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $buscaOp = BancoOperador::find()->where(['status' => 1])->all();
        $bancos = ArrayHelper::map($buscaOp, 'id', 'nombre_banco');         

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'La Cuenta Bancaria fué modificada de manera exitosa.');
            return $this->redirect(Yii::$app->request->referrer);           
        }

        return $this->render('update', [
            'model' => $model,
            'bancos' => $bancos,
        ]);
    }

    /**
     * Deletes an existing Bancos model.
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
     * Finds the Bancos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Bancos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Bancos::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
