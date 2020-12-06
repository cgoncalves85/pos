<?php

namespace app\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use app\models\MovBancarios;
use app\models\MovBancarioTipo;
use app\models\Bancos;
use app\models\search\MovBancarioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MovBancariosController implements the CRUD actions for MovBancarios model.
 */
class MovBancariosController extends Controller
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
     * Lists all MovBancarios models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new MovBancarios();

        $buscaTipo = MovBancarioTipo::find()->where(['status' => 1])->all();
        $tipos = ArrayHelper::map($buscaTipo, 'id', 'descripcion'); 

        $buscaBanco = (new \yii\db\Query())
            ->select(['banco_operador.nombre_banco', 'bancos.*'])
            ->from('banco_operador', 'bancos')
            ->leftJoin('bancos', 'banco_operador.id = bancos.banco_operador_id')
            ->where(['bancos.status' => '1'])
            ->all();
        $bancos = ArrayHelper::map($buscaBanco, 'id', 'nro_cuenta', 'nombre_banco'); 

        $searchModel = new MovBancarioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->setPagination(['pageSize' => 10]);

        if ($model->load(Yii::$app->request->post()) ) {
            $id_banco = $model->banco_id;
            $id_tipo = $model->tipo_movimiento_id;
            $monto = $model->valor;

            $tipo = MovBancarioTipo::find()->where(['id' => $id_tipo])->one();
            $tipo_mov = $tipo->tipo_movimiento;

            $datos_banco = Bancos::find()->where(['id' => $id_banco])->one();
            $saldo_disponible = $datos_banco->saldo_disponible;            

            if (($tipo_mov == 2) && ($monto > $saldo_disponible)) {
                Yii::$app->session->setFlash('error', 'El Monto No puede ser mayor al Saldo Disponible en la CUenta ! Verifique e Intente Nuevamente.');
                return $this->redirect(['index']);                
            }

            if ($tipo_mov == 1) {

                $nuevo_saldo = $saldo_disponible + $model->valor;
                $datos_banco->saldo_disponible = $nuevo_saldo;
                $datos_banco->save();
            }

            if ($tipo_mov == 2) {
                $nuevo_saldo = $saldo_disponible - $model->valor;
                $datos_banco->saldo_disponible = $nuevo_saldo;
                $datos_banco->save();
            }            

            $model->save();
            Yii::$app->session->setFlash('success', 'El Movimiento Bancario fué realizado de manera exitosa.');
            return $this->redirect(['index']);
        }        

        return $this->render('index', [
            'model' => $model,
            'tipos' => $tipos,
            'bancos' => $bancos,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MovBancarios model.
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
     * Creates a new MovBancarios model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MovBancarios();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing MovBancarios model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $buscaTipo = MovBancarioTipo::find()->where(['status' => 1])->all();
        $tipos = ArrayHelper::map($buscaTipo, 'id', 'descripcion'); 

        $buscaBanco = (new \yii\db\Query())
            ->select(['banco_operador.nombre_banco', 'bancos.*'])
            ->from('banco_operador', 'bancos')
            ->leftJoin('bancos', 'banco_operador.id = bancos.banco_operador_id')
            ->where(['bancos.status' => '1'])
            ->all();
        $bancos = ArrayHelper::map($buscaBanco, 'id', 'nro_cuenta', 'nombre_banco'); 

        if ($model->load(Yii::$app->request->post()) ) {
            $id_banco = $model->banco_id;
            $id_tipo = $model->tipo_movimiento_id;

            $tipo = MovBancarioTipo::find()->where(['id' => $id_tipo])->one();
            $tipo_mov = $tipo->tipo_movimiento;

            if ($tipo_mov == 1) {
                $datos_banco = Bancos::find()->where(['id' => $id_banco])->one();
                $saldo_disponible = $datos_banco->saldo_disponible;
                $nuevo_saldo = $saldo_disponible + $model->valor;
                $datos_banco->saldo_disponible = $nuevo_saldo;
                $datos_banco->save();
            }

            if ($tipo_mov == 2) {
                $datos_banco = Bancos::find()->where(['id' => $id_banco])->one();
                $saldo_disponible = $datos_banco->saldo_disponible;
                $nuevo_saldo = $saldo_disponible - $model->valor;
                $datos_banco->saldo_disponible = $nuevo_saldo;
                $datos_banco->save();
            }            

            $model->save();
            Yii::$app->session->setFlash('success', 'El Movimiento Bancario fué modificado de manera exitosa.');
            return $this->redirect(['index']);
        }   

        return $this->render('update', [
            'model' => $model,
            'tipos' => $tipos,
            'bancos' => $bancos,
        ]);
    }

    /**
     * Deletes an existing MovBancarios model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $movimiento = MovBancarios::findOne($id);
        $id_banco = $movimiento->banco_id;
        $id_tipo = $movimiento->tipo_movimiento_id;

        $tipo = MovBancarioTipo::find()->where(['id' => $id_tipo])->one();
        $tipo_mov = $tipo->tipo_movimiento;        

        if ($tipo_mov == 1) {
            $datos_banco = Bancos::find()->where(['id' => $id_banco])->one();
            $saldo_disponible = $datos_banco->saldo_disponible;
            $nuevo_saldo = $saldo_disponible - $movimiento->valor;
            $datos_banco->saldo_disponible = $nuevo_saldo;
            $datos_banco->save();
        }

        if ($tipo_mov == 2) {
            $datos_banco = Bancos::find()->where(['id' => $id_banco])->one();
            $saldo_disponible = $datos_banco->saldo_disponible;
            $nuevo_saldo = $saldo_disponible + $movimiento->valor;
            $datos_banco->saldo_disponible = $nuevo_saldo;
            $datos_banco->save();
        }        

        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', 'El Movimiento Bancario fué eliminado de manera exitosa.');
        return $this->redirect(['index']);
    }

    /**
     * Finds the MovBancarios model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MovBancarios the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MovBancarios::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
