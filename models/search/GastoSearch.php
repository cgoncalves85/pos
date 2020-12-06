<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Gastos;

/**
 * GastoSearch represents the model behind the search form of `app\models\Gastos`.
 */
class GastoSearch extends Gastos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'proveedor_id', 'tienda_id', 'forma_pago_id', 'impuesto_id', 'gastos_categorias_id', 'gastos_subcategorias_id', 'banco_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['descripcion', 'fecha', 'nro_referencia', 'nota', 'created_at', 'updated_at'], 'safe'],
            [['monto'], 'number'],
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
    public function search($params)
    {
        $query = Gastos::find();

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
            'proveedor_id' => $this->proveedor_id,
            'fecha' => $this->fecha,
            'tienda_id' => $this->tienda_id,
            'forma_pago_id' => $this->forma_pago_id,
            'monto' => $this->monto,
            'impuesto_id' => $this->impuesto_id,
            'gastos_categorias_id' => $this->gastos_categorias_id,
            'gastos_subcategorias_id' => $this->gastos_subcategorias_id,
            'banco_id' => $this->banco_id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'nro_referencia', $this->nro_referencia])
            ->andFilterWhere(['like', 'nota', $this->nota]);

        return $dataProvider;
    }
}
