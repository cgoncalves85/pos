<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Inventario;
use app\models\User;

/**
 * InventarioSearch represents the model behind the search form of `app\models\Inventario`.
 */
class InventarioSearch extends Inventario
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'tienda_id', 'orden_compra_id', 'tienda_origen_id', 'tienda_destino_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['tipo_movimiento', 'nro_documento', 'fecha', 'observacion', 'created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchi($params)
    {
        $id_user = Yii::$app->user->id;
        $datos = User::find()->where(['id' => $id_user])->one();
        $id_tienda = $datos->tienda_id;

        $query = Inventario::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'fecha' => $this->fecha,
            'tienda_id' => $id_tienda,
            'tipo_movimiento' => 'INGRESO',
            'orden_compra_id' => $this->orden_compra_id,
            'tienda_origen_id' => $this->tienda_origen_id,
            'tienda_destino_id' => $this->tienda_destino_id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'tipo_movimiento', $this->tipo_movimiento])
            ->andFilterWhere(['like', 'nro_documento', $this->nro_documento])
            ->andFilterWhere(['like', 'observacion', $this->observacion]);

        return $dataProvider;
    }

    public function searche($params)
    {
        $id_user = Yii::$app->user->id;
        $datos = User::find()->where(['id' => $id_user])->one();
        $id_tienda = $datos->tienda_id;

        $query = Inventario::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'fecha' => $this->fecha,
            'tienda_id' => $id_tienda,
            'tipo_movimiento' => 'EGRESO',
            'orden_compra_id' => $this->orden_compra_id,
            'tienda_origen_id' => $this->tienda_origen_id,
            'tienda_destino_id' => $this->tienda_destino_id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'tipo_movimiento', $this->tipo_movimiento])
            ->andFilterWhere(['like', 'nro_documento', $this->nro_documento])
            ->andFilterWhere(['like', 'observacion', $this->observacion]);

        return $dataProvider;
    }

}
