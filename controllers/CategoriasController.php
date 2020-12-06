<?php

namespace app\controllers;

use Yii;
use app\models\Categorias;
use app\models\search\CategoriaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use app\models\AccessHelpers;

/**
 * CategoriasController implements the CRUD actions for Categorias model.
 */
class CategoriasController extends Controller
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
     * Lists all Categorias models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new Categorias();

        $searchModel = new CategoriaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->setPagination(['pageSize' => 10]);

        if ($model->load(Yii::$app->request->post()) ) {
            $image = UploadedFile::getInstance($model, 'image');

            if (!is_null($image)) {

                //$ext = explode(".", $image->name);
                //$ext = end($ext);
                $model->imagen = $image->name;
                 
                Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web/uploads/categorias/';
                $path = Yii::$app->params['uploadPath'] . $model->imagen;
                $image->saveAs($path);
            }

            if ($model->save()) {             
                return $this->redirect(['index']);             
            }
        }        

        return $this->render('index', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Categorias model.
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
     * Creates a new Categorias model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Categorias();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Categorias model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) ) {
            $image = UploadedFile::getInstance($model, 'image');

            if (!is_null($image)) {

                //$ext = explode(".", $image->name);
                //$ext = end($ext);
                $model->imagen = $image->name;
                 
                Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web/uploads/categorias/';
                $path = Yii::$app->params['uploadPath'] . $model->imagen;
                $image->saveAs($path);
            }

            if ($model->save()) {             
                return $this->redirect(['index']);             
            }
        }   

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Categorias model.
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
     * Finds the Categorias model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Categorias the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Categorias::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
