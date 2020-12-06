<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Bancos;

/**
 * BancoSearch represents the model behind the search form of `app\models\Bancos`.
 */
class BancoSearch extends Bancos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'banco_operador_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['nro_cuenta', 'descripcion_cuenta', 'created_at', 'updated_at'], 'safe'],
            [['saldo_inicial', 'saldo_disponible'], 'number'],
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
        $query = Bancos::find();

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
            'banco_operador_id' => $this->banco_operador_id,
            'saldo_inicial' => $this->saldo_inicial,
            'saldo_disponible' => $this->saldo_disponible,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'nro_cuenta', $this->nro_cuenta])
            ->andFilterWhere(['like', 'descripcion_cuenta', $this->descripcion_cuenta]);

        return $dataProvider;
    }
}
