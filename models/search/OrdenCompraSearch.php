<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\OrdenCompra;

/**
 * OrdenCompraSearch represents the model behind the search form of `app\models\OrdenCompra`.
 */
class OrdenCompraSearch extends OrdenCompra
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'proveedor_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['nro_documento', 'fecha', 'created_at', 'updated_at'], 'safe'],
            [['utilidad_total'], 'number'],
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
        $query = OrdenCompra::find();

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
            'utilidad_total' => $this->utilidad_total,
            'fecha' => $this->fecha,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'nro_documento', $this->nro_documento]);

        return $dataProvider;
    }
}
