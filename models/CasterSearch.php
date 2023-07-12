<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Caster;

/**
 * CasterSearch represents the model behind the search form of `app\models\Caster`.
 */
class CasterSearch extends Caster
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'shift', 'running_time', 'width', 'actual_out', 'parent_id', 'coil_number_id', 'order_id', 'actual_width', 'weight_processed', 'plan_out', 'scrap_coil', 'scrap_drain', 'scrap_qc', 'strip_speed', 'melting_temp', 'holding_temp', 'tap_out_temp', 'alpur_temp', 'headbox_temp', 'cff_no', 'is_finish', 'is_processed', 'change_alloy', 'create_by', 'modi_by'], 'integer'],
            [['cast_date', 'act_date', 'coil_number', 'start', 'finish', 'alloy_type', 'alloy_code', 'machine_id', 'machine_code', 'alloy', 'datetime_start', 'datetime_finish', 'grain_size', 'cls', 'supervisor', 'operator', 'helper', 'helper2', 'remark', 'qc_status', 'final_qc_status', 'status', 'currency_code', 'next_machine', 'is_continue', 'is_planned', 'is_processed_date', 'supplied', 'alloy_original', 'created', 'modified'], 'safe'],
            [['actual_thickness', 'thickness', 'scrap_ba', 'weight', 'pc', 'rpc', 'fe', 'si', 'cu', 'mn', 'mg', 'zn', 'ti', 'al', 'h2', 'li', 'lme_price', 'kurs', 'premium', 'lme_price_paid', 'kurs_paid', 'premium_paid'], 'number'],
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
        $query = Caster::find()->where(['month(act_date)'=>date('m'), 'year(act_date)'=>date('Y')]);

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
            'cast_date' => $this->cast_date,
            'act_date' => $this->act_date,
            'shift' => $this->shift,
            'start' => $this->start,
            'finish' => $this->finish,
            'running_time' => $this->running_time,
            'actual_thickness' => $this->actual_thickness,
            'width' => $this->width,
            'actual_out' => $this->actual_out,
            'parent_id' => $this->parent_id,
            'coil_number_id' => $this->coil_number_id,
            'datetime_start' => $this->datetime_start,
            'order_id' => $this->order_id,
            'datetime_finish' => $this->datetime_finish,
            'thickness' => $this->thickness,
            'actual_width' => $this->actual_width,
            'weight_processed' => $this->weight_processed,
            'plan_out' => $this->plan_out,
            'scrap_coil' => $this->scrap_coil,
            'scrap_drain' => $this->scrap_drain,
            'scrap_ba' => $this->scrap_ba,
            'scrap_qc' => $this->scrap_qc,
            'weight' => $this->weight,
            'strip_speed' => $this->strip_speed,
            'melting_temp' => $this->melting_temp,
            'holding_temp' => $this->holding_temp,
            'tap_out_temp' => $this->tap_out_temp,
            'alpur_temp' => $this->alpur_temp,
            'headbox_temp' => $this->headbox_temp,
            'pc' => $this->pc,
            'rpc' => $this->rpc,
            'cff_no' => $this->cff_no,
            'fe' => $this->fe,
            'si' => $this->si,
            'cu' => $this->cu,
            'mn' => $this->mn,
            'mg' => $this->mg,
            'zn' => $this->zn,
            'ti' => $this->ti,
            'al' => $this->al,
            'h2' => $this->h2,
            'li' => $this->li,
            'lme_price' => $this->lme_price,
            'kurs' => $this->kurs,
            'premium' => $this->premium,
            'lme_price_paid' => $this->lme_price_paid,
            'kurs_paid' => $this->kurs_paid,
            'premium_paid' => $this->premium_paid,
            'is_finish' => $this->is_finish,
            'is_processed' => $this->is_processed,
            'is_processed_date' => $this->is_processed_date,
            'change_alloy' => $this->change_alloy,
            'create_by' => $this->create_by,
            'created' => $this->created,
            'modi_by' => $this->modi_by,
            'modified' => $this->modified,
        ]);

        $query->andFilterWhere(['like', 'coil_number', $this->coil_number])
            ->andFilterWhere(['like', 'alloy_type', $this->alloy_type])
            ->andFilterWhere(['like', 'alloy_code', $this->alloy_code])
            ->andFilterWhere(['like', 'machine_id', $this->machine_id])
            ->andFilterWhere(['like', 'machine_code', $this->machine_code])
            ->andFilterWhere(['like', 'alloy', $this->alloy])
            ->andFilterWhere(['like', 'grain_size', $this->grain_size])
            ->andFilterWhere(['like', 'cls', $this->cls])
            ->andFilterWhere(['like', 'supervisor', $this->supervisor])
            ->andFilterWhere(['like', 'operator', $this->operator])
            ->andFilterWhere(['like', 'helper', $this->helper])
            ->andFilterWhere(['like', 'helper2', $this->helper2])
            ->andFilterWhere(['like', 'remark', $this->remark])
            ->andFilterWhere(['like', 'qc_status', $this->qc_status])
            ->andFilterWhere(['like', 'final_qc_status', $this->final_qc_status])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'currency_code', $this->currency_code])
            ->andFilterWhere(['like', 'next_machine', $this->next_machine])
            ->andFilterWhere(['like', 'is_continue', $this->is_continue])
            ->andFilterWhere(['like', 'is_planned', $this->is_planned])
            ->andFilterWhere(['like', 'supplied', $this->supplied])
            ->andFilterWhere(['like', 'alloy_original', $this->alloy_original]);

        return $dataProvider;
    }
}
