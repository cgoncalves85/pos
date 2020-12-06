<?php

namespace app\controllers;

use Yii;
use app\models\Cajas;
use app\models\Tiendas;
use yii\helpers\ArrayHelper;
use app\models\search\CajaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\AccessHelpers;

/**
 * CajasController implements the CRUD actions for Cajas model.
 */
class CajasController extends Controller
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

    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }
     
        $operacion = str_replace("/", "-", Yii::$app->controller->route);
     
        $permitirSiempre = ['site-captcha', 'site-index', 'site-error', 'site-contact', 'site-login', 'site-logout'];
     
        if (in_array($operacion, $permitirSiempre)) {
            return true;
        }
     
        if (!AccessHelpers::getAcceso($operacion)) {
            echo $this->render('../nopermitido');
            exit;
            return false;
        }
     
        return true;
    }    

    /**
     * Lists all Cajas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new Cajas();

        $buscaT = Tiendas::find()->where(['status' => 1])->all();
        $tiendas = ArrayHelper::map($buscaT, 'id', 'nombre'); 

        $searchModel = new CajaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->setPagination(['pageSize' => 10]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
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
     * Displays a single Cajas model.
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
     * Creates a new Cajas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Cajas();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Cajas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $buscaT = Tiendas::find()->where(['status' => 1])->all();
        $tiendas = ArrayHelper::map($buscaT, 'id', 'nombre');         

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
            'tiendas' => $tiendas,
        ]);
    }

    /**
     * Deletes an existing Cajas model.
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
     * Finds the Cajas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cajas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cajas::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
