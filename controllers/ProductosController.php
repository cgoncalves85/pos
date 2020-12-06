<?php

namespace app\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use app\models\Productos;
use app\models\Medidas;
use app\models\Categorias;
use app\models\Impuestos;
use app\models\search\ProductoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use app\models\AccessHelpers;

/**
 * ProductosController implements the CRUD actions for Productos model.
 */
class ProductosController extends Controller
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
     * Lists all Productos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new Productos();

        $buscaCat = Categorias::find()->where(['status' => 1])->all();
        $categorias = ArrayHelper::map($buscaCat, 'id', 'categoria'); 

        $buscaM = Medidas::find()->where(['status' => 1])->all();
        $medidas = ArrayHelper::map($buscaM, 'id', 'medida'); 

        $buscaImp = Impuestos::find()->all();
        for ($i=0; $i < count($buscaImp) ; $i++) { 
            $campos[$i] = array('id' => $buscaImp[$i]->id, 'dato' => $buscaImp[$i]->valor.' % ');
        }
        $impuestos = ArrayHelper::map($campos, 'id', 'dato'); 

        $searchModel = new ProductoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->setPagination(['pageSize' => 10]);

        if ($model->load(Yii::$app->request->post()) ) {
            $image = UploadedFile::getInstance($model, 'image');

            if (!is_null($image)) {
                $model->imagen = $image->name;
                 
                Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web/uploads/productos/';
                $path = Yii::$app->params['uploadPath'] . $model->imagen;
                $image->saveAs($path);
            }

            if ($model->save()) {             
                return $this->redirect(['index']);             
            }
        } 

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'categorias' => $categorias,
            'impuestos' => $impuestos,
            'medidas' => $medidas,
            'model' => $model,            
        ]);
    }

    /**
     * Displays a single Productos model.
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
     * Creates a new Productos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Productos();

        $buscaCat = Categorias::find()->where(['status' => 1])->all();
        $categorias = ArrayHelper::map($buscaCat, 'id', 'categoria'); 

        $buscaM = Medidas::find()->where(['status' => 1])->all();
        $medidas = ArrayHelper::map($buscaM, 'id', 'medida');         

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
            'categorias' => $categorias,
            'medidas' => $medidas,
        ]);
    }

    /**
     * Updates an existing Productos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $buscaCat = Categorias::find()->where(['status' => 1])->all();
        $categorias = ArrayHelper::map($buscaCat, 'id', 'categoria'); 

        $buscaM = Medidas::find()->where(['status' => 1])->all();
        $medidas = ArrayHelper::map($buscaM, 'id', 'medida');

        $buscaImp = Impuestos::find()->all();
        for ($i=0; $i < count($buscaImp) ; $i++) { 
            $campos[$i] = array('id' => $buscaImp[$i]->id, 'dato' => $buscaImp[$i]->valor.' % ');
        }
        $impuestos = ArrayHelper::map($campos, 'id', 'dato');                  

        if ($model->load(Yii::$app->request->post()) ) {
            $image = UploadedFile::getInstance($model, 'image');

            if (!is_null($image)) {
                $model->imagen = $image->name;
                 
                Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web/uploads/productos/';
                $path = Yii::$app->params['uploadPath'] . $model->imagen;
                $image->saveAs($path);
            }

            if ($model->save()) {             
                return $this->redirect(['index']);             
            }
        } 

        return $this->render('update', [
            'model' => $model,
            'categorias' => $categorias,
            'impuestos' => $impuestos,
            'medidas' => $medidas,            
        ]);
    }

    /**
     * Deletes an existing Productos model.
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
     * Finds the Productos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Productos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Productos::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
