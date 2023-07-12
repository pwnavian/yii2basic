<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Machine;

/**
 * MachineSearch represents the model behind the search form of `app\models\Machine`.
 */
class MachineSearch extends Machine
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'machine_code', 'machine_group_code', 'machine_group_name', 'machine_name', 'model_name', 'category_id', 'category_kode', 'status', 'created', 'modified'], 'safe'],
            [['urut', 'qty_phase', 'create_by', 'modi_by'], 'integer'],
            [['productivity_target'], 'number'],
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
        $query = Machine::find();

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
            'urut' => $this->urut,
            'qty_phase' => $this->qty_phase,
            'productivity_target' => $this->productivity_target,
            'create_by' => $this->create_by,
            'created' => $this->created,
            'modi_by' => $this->modi_by,
            'modified' => $this->modified,
        ]);

        $query->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'machine_code', $this->machine_code])
            ->andFilterWhere(['like', 'machine_group_code', $this->machine_group_code])
            ->andFilterWhere(['like', 'machine_group_name', $this->machine_group_name])
            ->andFilterWhere(['like', 'machine_name', $this->machine_name])
            ->andFilterWhere(['like', 'model_name', $this->model_name])
            ->andFilterWhere(['like', 'category_id', $this->category_id])
            ->andFilterWhere(['like', 'category_kode', $this->category_kode])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
