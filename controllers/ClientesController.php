<?php

namespace app\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use app\models\Clientes;
use app\models\ClientesCategorias;
use app\models\search\ClientesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\AccessHelpers;

/**
 * ClientesController implements the CRUD actions for Clientes model.
 */
class ClientesController extends Controller
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
     * Lists all Clientes models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new Clientes();

        $model->status = 1;
        $searchModel = new ClientesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->setPagination(['pageSize' => 10]);

        $buscaCat = ClientesCategorias::find()->where(['status' => 1])->all();
        $categorias_cliente = ArrayHelper::map($buscaCat, 'id', 'categoria');        

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
            'categorias_cliente' => $categorias_cliente,
        ]);
    }

    /**
     * Displays a single Clientes model.
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
     * Creates a new Clientes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Clientes();

        $buscaCat = ClientesCategorias::find()->where(['status' => 1])->all();
        $categorias_cliente = ArrayHelper::map($buscaCat, 'id', 'categoria');        

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'El Cliente fue agregado de manera exitosa.');
            return $this->redirect(['ventas/vender']);
        }

        return $this->renderAjax('create', [
            'model' => $model,
            'categorias_cliente' => $categorias_cliente,
        ]);
    }

    /**
     * Updates an existing Clientes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $buscaCat = ClientesCategorias::find()->where(['status' => 1])->all();
        $categorias_cliente = ArrayHelper::map($buscaCat, 'id', 'categoria');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
            'categorias_cliente' => $categorias_cliente,
        ]);
    }

    /**
     * Deletes an existing Clientes model.
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
     * Finds the Clientes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Clientes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Clientes::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
