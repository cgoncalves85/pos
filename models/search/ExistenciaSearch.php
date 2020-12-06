<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Existencias;
use app\models\User;

/**
 * ExistenciaSearch represents the model behind the search form of `app\models\Existencias`.
 */
class ExistenciaSearch extends Existencias
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'tienda_id', 'producto_id'], 'integer'],
            [['cantidad'], 'number'],
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

        $id_user = Yii::$app->user->id;
        $datos = User::find()->where(['id' => $id_user])->one();
        $id_tienda = $datos->tienda_id;

        $query = Existencias::find();

        // add conditions that should always apply here

        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $query;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'tienda_id' => $id_tienda,
            'producto_id' => $this->producto_id,
            'cantidad' => $this->cantidad,
        ]);       

        return $dataProvider;
    }
}
