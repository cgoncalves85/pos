<?php

namespace app\controllers;

use Yii;
use app\models\Rol;
use app\models\search\RolSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Operacion;
use app\models\AccessHelpers;

/**
 * RolController implements the CRUD actions for Rol model.
 */
class RolController extends Controller
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
     * Lists all Rol models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new Rol();
        $tipoOperaciones = Operacion::find()->all();        

        $searchModel = new RolSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
            'tipoOperaciones' => $tipoOperaciones            
        ]);
    }

    /**
     * Displays a single Rol model.
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
     * Creates a new Rol model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    public function actionCreate()
    {
        $model = new Rol();
        $tipoOperaciones = Operacion::find()->all();
     
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'tipoOperaciones' => $tipoOperaciones
            ]);
        }
    }    

    /**
     * Updates an existing Rol model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $tipoOperaciones = Operacion::find()->all();
     
        $model->operaciones = \yii\helpers\ArrayHelper::getColumn(
            $model->getRolOperaciones()->asArray()->all(),
            'operacion_id'
        );
     
        if ($model->load(Yii::$app->request->post())) {
            if (!isset($_POST['Rol']['operaciones'])) {
                $model->operaciones = [];
            }
            if ($model->save()) {
                return $this->redirect(['index']);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'tipoOperaciones' => $tipoOperaciones
            ]);
        }
    }

    /**
     * Deletes an existing Rol model.
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
     * Finds the Rol model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Rol the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Rol::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
