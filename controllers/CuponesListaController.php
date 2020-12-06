<?php

namespace app\controllers;

use Yii;
use app\models\CuponesLista;
use app\models\Cupones;
use app\models\search\CuponesListaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CuponesListaController implements the CRUD actions for CuponesLista model.
 */
class CuponesListaController extends Controller
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
     * Lists all CuponesLista models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new CuponesLista();

        $searchModel = new CuponesListaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->setPagination(['pageSize' => 10]);

        if ($model->load(Yii::$app->request->post())) {

            $fecha_inicio = date('Y-m-d', strtotime($model->fecha_inicio));
            $model->fecha_inicio = $fecha_inicio;

            $fecha_fin = date('Y-m-d', strtotime($model->fecha_fin));
            $model->fecha_fin = $fecha_fin; 

            $model->status = 1;
            $cant_cupones = $model->cantidad_cupones;

            $id_lista = CuponesLista::find()->max('id');
            if ($id_lista == NULL) {
                $id_lista = 1;
            } else {
                $id_lista = $id_lista + 1;
            }

            for ($i=0; $i < $cant_cupones ; $i++) { 
                $modelCupones = new Cupones();
                $modelCupones->id_lista = $id_lista;
                $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
                $modelCupones->cupon =  substr(str_shuffle($permitted_chars), 0, 10);
                $modelCupones->descripcion = 'Cupón de Descuento: '.$model->porcentaje_descuento.'%';
                $modelCupones->porcentaje_descuento = $model->porcentaje_descuento;
                $modelCupones->status = 1;
                $modelCupones->save(); 

                $cupon_guardado = Cupones::find()->max('id');
                $buscarCupon = Cupones::findOne($cupon_guardado);

                $cupon = $buscarCupon->cupon;
                $descuento = $buscarCupon->porcentaje_descuento;

                $query = (new \yii\db\Query())
                    ->select(['clientes.*'])
                    ->from('clientes')
                    ->where(['status' => '1'])
                    ->orderBy(['rand()' => SORT_DESC])
                    ->limit(1);
                $command = $query->createCommand();
                $cliente = $command->queryAll();

                /* ACTIVAR LUEGO DE CONFIGURAR EL CORREO
                $correo = Yii::$app->mailer->compose(['html' => 'cuponesDescuento-html'], [
                    'cupon' => $cupon,
                    'descuento' => $descuento,
                    'cliente' => $cliente,
                ]);

                $correo->setTo($cliente[0]['correo'])
                ->setFrom([Yii::$app->params['promoEmail'] => 'Promociones - '.Yii::$app->name])
                ->setSubject('Oportunidad de Promoción - Cupón de Descuento')
                ->send();
                */
            }
            $model->save();
            Yii::$app->session->setFlash('success', 'El Listado de Cupones se ha generado de manera exitosa.');
            return $this->redirect(['index']); 
            
        }        

        return $this->render('index', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CuponesLista model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $disponibles = Cupones::find()->where(['id_lista' => $id])->andWhere(['status' => 1])->all();
        $usados = Cupones::find()->where(['id_lista' => $id])->andWhere(['status' => 0])->all();
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
            'disponibles' => $disponibles,
            'usados' => $usados,
        ]);
    }

    /**
     * Creates a new CuponesLista model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CuponesLista();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing CuponesLista model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $listaCupones = Cupones::find()->where(['id_lista' => $id])->all();

        $model->fecha_inicio = date('d-m-Y', strtotime($model->fecha_inicio));
        $model->fecha_fin = date('d-m-Y', strtotime($model->fecha_fin));


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'listaCupones' => $listaCupones,
        ]);
    }

    public function actionUpdateCupon($id)
    {
        $model = Cupones::findOne($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'El Cupón ha sido actualizado de manera exitosa.');
            return $this->redirect(Yii::$app->request->referrer); 
        }

        return $this->renderAjax('update-cupon', [
            'model' => $model,
        ]);
    }    

    /**
     * Deletes an existing CuponesLista model.
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
     * Finds the CuponesLista model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CuponesLista the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CuponesLista::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
