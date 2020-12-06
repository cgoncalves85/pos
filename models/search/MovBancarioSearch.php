<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MovBancarios;

/**
 * MovBancarioSearch represents the model behind the search form of `app\models\MovBancarios`.
 */
class MovBancarioSearch extends MovBancarios
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'banco_id', 'tipo_movimiento_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['nro_referencia', 'observacion', 'nota_impresion', 'created_at', 'updated_at'], 'safe'],
            [['valor'], 'number'],
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
        $query = MovBancarios::find();

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
            'banco_id' => $this->banco_id,
            'tipo_movimiento_id' => $this->tipo_movimiento_id,
            'valor' => $this->valor,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'nro_referencia', $this->nro_referencia])
            ->andFilterWhere(['like', 'observacion', $this->observacion])
            ->andFilterWhere(['like', 'nota_impresion', $this->nota_impresion]);

        return $dataProvider;
    }
}
