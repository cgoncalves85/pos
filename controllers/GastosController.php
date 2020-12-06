<?php

namespace app\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use app\models\Gastos;
use app\models\search\GastoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Proveedores;
use app\models\Tiendas;
use app\models\FormaPago;
use app\models\Impuestos;
use app\models\GastosCategorias;

/**
 * GastosController implements the CRUD actions for Gastos model.
 */
class GastosController extends Controller
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
     * Lists all Gastos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new Gastos();

        $buscaP = Proveedores::find()->where(['status' => 1])->all();
        $proveedores = ArrayHelper::map($buscaP, 'id', 'nombre');    

        $buscaT = Tiendas::find()->where(['status' => 1])->all();
        $tiendas = ArrayHelper::map($buscaT, 'id', 'nombre'); 

        $buscaFP = FormaPago::find()->where(['status' => 1])->all();
        $formas = ArrayHelper::map($buscaFP, 'id', 'descripcion'); 

        $buscaImp = Impuestos::find()->all();
        $impuestos = ArrayHelper::map($buscaImp, 'id', 'descripcion');

        $cuentas = ['1' => 'Caja', '2' => 'Cuenta de Banco'];

        $buscaBanco = (new \yii\db\Query())
            ->select(['banco_operador.nombre_banco', 'bancos.*'])
            ->from('banco_operador', 'bancos')
            ->leftJoin('bancos', 'banco_operador.id = bancos.banco_operador_id')
            ->where(['bancos.status' => '1'])
            ->all();
        $bancos = ArrayHelper::map($buscaBanco, 'id', 'nro_cuenta', 'nombre_banco');

        $buscaCat = GastosCategorias::find()->where(['status' => 1])->all();
        $categorias = ArrayHelper::map($buscaCat, 'id', 'categoria');                                               

        $searchModel = new GastoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->setPagination(['pageSize' => 10]);

        if ($model->load(Yii::$app->request->post()) ) {
            $fecha = date('Y-m-d', strtotime($model->fecha));
            $model->fecha = $fecha;
            $model->save();           
            Yii::$app->session->setFlash('success', 'El Gasto fué creado de manera exitosa.');
            return $this->redirect(['index']); 
        }        

        return $this->render('index', [
            'model' => $model,
            'proveedores' => $proveedores,
            'tiendas' => $tiendas,
            'formas' => $formas,
            'impuestos' => $impuestos,
            'cuentas' => $cuentas,
            'bancos' => $bancos,
            'categorias' => $categorias,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Gastos model.
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
     * Creates a new Gastos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Gastos();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Gastos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $buscaP = Proveedores::find()->where(['status' => 1])->all();
        $proveedores = ArrayHelper::map($buscaP, 'id', 'nombre');    

        $buscaT = Tiendas::find()->where(['status' => 1])->all();
        $tiendas = ArrayHelper::map($buscaT, 'id', 'nombre'); 

        $buscaFP = FormaPago::find()->where(['status' => 1])->all();
        $formas = ArrayHelper::map($buscaFP, 'id', 'descripcion'); 

        $buscaImp = Impuestos::find()->all();
        $impuestos = ArrayHelper::map($buscaImp, 'id', 'descripcion');

        $cuentas = ['1' => 'Caja', '2' => 'Cuenta de Banco'];

        $buscaBanco = (new \yii\db\Query())
            ->select(['banco_operador.nombre_banco', 'bancos.*'])
            ->from('banco_operador', 'bancos')
            ->leftJoin('bancos', 'banco_operador.id = bancos.banco_operador_id')
            ->where(['bancos.status' => '1'])
            ->all();
        $bancos = ArrayHelper::map($buscaBanco, 'id', 'nro_cuenta', 'nombre_banco');

        $buscaCat = GastosCategorias::find()->where(['status' => 1])->all();
        $categorias = ArrayHelper::map($buscaCat, 'id', 'categoria'); 

        if ($model->load(Yii::$app->request->post()) ) {
            $fecha = date('Y-m-d', strtotime($model->fecha));
            $model->fecha = $fecha;
            $model->save();           
            Yii::$app->session->setFlash('success', 'El Gasto fué modificado de manera exitosa.');
            return $this->redirect(['index']); 
        } 

        return $this->render('update', [
            'model' => $model,
            'proveedores' => $proveedores,
            'tiendas' => $tiendas,
            'formas' => $formas,
            'impuestos' => $impuestos,
            'cuentas' => $cuentas,
            'bancos' => $bancos,
            'categorias' => $categorias,            
        ]);
    }

    /**
     * Deletes an existing Gastos model.
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

    public function actionSubcategorias()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $id = $parents[0];
                $out = Gastos::getSubcat($id);
                return Json::encode(['output' => $out, 'selected' => '']);
            }
        }
        return Json::encode(['output' => '', 'selected' => '']);
    }     

    /**
     * Finds the Gastos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Gastos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Gastos::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
