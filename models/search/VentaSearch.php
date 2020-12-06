<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Ventas;

/**
 * VentaSearch represents the model behind the search form of `app\models\Ventas`.
 */
class VentaSearch extends Ventas
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'caja_id', 'nro_documento', 'cliente_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['fecha', 'created_at', 'updated_at'], 'safe'],
            [['subtotal', 'impuesto', 'total'], 'number'],
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
        $query = Ventas::find();

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
            'user_id' => $this->user_id,
            'nro_documento' => $this->nro_documento,
            'caja_id' => $this->caja_id,
            'fecha' => $this->fecha,
            'cliente_id' => $this->cliente_id,
            'subtotal' => $this->subtotal,
            'impuesto' => $this->impuesto,
            'total' => $this->total,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        return $dataProvider;
    }
}
