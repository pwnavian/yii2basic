<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ctm_dpr_trx_caster_tab".
 *
 * @property int $id
 * @property string|null $cast_date
 * @property string|null $act_date
 * @property string|null $coil_number
 * @property int|null $shift
 * @property string|null $start
 * @property string|null $finish
 * @property int|null $running_time
 * @property float|null $actual_thickness
 * @property int|null $width
 * @property int|null $actual_out
 * @property int|null $parent_id
 * @property int|null $coil_number_id
 * @property string|null $alloy_type
 * @property string|null $alloy_code
 * @property string|null $machine_id
 * @property string|null $machine_code
 * @property string|null $alloy
 * @property string|null $datetime_start
 * @property int|null $order_id
 * @property string|null $datetime_finish
 * @property float|null $thickness
 * @property int|null $actual_width
 * @property int|null $weight_processed
 * @property int|null $plan_out
 * @property int|null $scrap_coil
 * @property int|null $scrap_drain
 * @property float|null $scrap_ba
 * @property int|null $scrap_qc
 * @property float|null $weight
 * @property int|null $strip_speed
 * @property int|null $melting_temp
 * @property int|null $holding_temp
 * @property int|null $tap_out_temp
 * @property int|null $alpur_temp
 * @property int|null $headbox_temp
 * @property float|null $pc
 * @property float|null $rpc
 * @property string|null $grain_size
 * @property int|null $cff_no
 * @property float|null $fe
 * @property float|null $si
 * @property float|null $cu
 * @property float|null $mn
 * @property float|null $mg
 * @property float|null $zn
 * @property float|null $ti
 * @property float|null $al
 * @property float|null $h2
 * @property string|null $cls
 * @property float|null $li
 * @property string|null $supervisor
 * @property string|null $operator
 * @property string|null $helper
 * @property string|null $helper2
 * @property string|null $remark
 * @property string|null $qc_status
 * @property string|null $final_qc_status
 * @property string|null $status
 * @property float|null $lme_price
 * @property float|null $kurs
 * @property float|null $premium
 * @property float|null $lme_price_paid
 * @property float|null $kurs_paid
 * @property float|null $premium_paid
 * @property string|null $currency_code
 * @property string|null $next_machine
 * @property string|null $is_continue
 * @property string|null $is_planned
 * @property int|null $is_finish
 * @property int|null $is_processed
 * @property string|null $is_processed_date
 * @property string|null $supplied
 * @property int|null $change_alloy
 * @property string|null $alloy_original
 * @property int|null $create_by
 * @property string|null $created
 * @property int|null $modi_by
 * @property string|null $modified
 */
class Caster extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    
    public static function machineName(){
		return 'CSTA';
	}

    public static function tableName()
    {
        return 'ctm_dpr_trx_caster_tab';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cast_date', 'act_date', 'start', 'finish', 'datetime_start', 'datetime_finish', 'is_processed_date', 'created', 'modified'], 'safe'],
            [['shift', 'running_time', 'width', 'actual_out', 'parent_id', 'coil_number_id', 'order_id', 'actual_width', 'weight_processed', 'plan_out', 'scrap_coil', 'scrap_drain', 'scrap_qc', 'strip_speed', 'melting_temp', 'holding_temp', 'tap_out_temp', 'alpur_temp', 'headbox_temp', 'cff_no', 'is_finish', 'is_processed', 'change_alloy', 'create_by', 'modi_by'], 'integer'],
            [['actual_thickness', 'thickness', 'scrap_ba', 'weight', 'pc', 'rpc', 'fe', 'si', 'cu', 'mn', 'mg', 'zn', 'ti', 'al', 'h2', 'li', 'lme_price', 'kurs', 'premium', 'lme_price_paid', 'kurs_paid', 'premium_paid'], 'number'],
            [['remark'], 'string'],
            [['coil_number'], 'string', 'max' => 16],
            [['alloy_type', 'alloy_code', 'machine_code', 'alloy', 'grain_size', 'next_machine'], 'string', 'max' => 10],
            [['machine_id'], 'string', 'max' => 36],
            [['cls', 'qc_status', 'final_qc_status', 'status', 'is_continue', 'is_planned', 'supplied'], 'string', 'max' => 1],
            [['supervisor', 'operator', 'helper', 'helper2'], 'string', 'max' => 30],
            [['currency_code'], 'string', 'max' => 3],
            [['alloy_original'], 'string', 'max' => 4],
        ];
    }


    public function tooltipInfo(){
        return [
            'coil_number'=>'Coil Number',
            'act_date'=>'Tanggal',
            'start'=>'Start',
            'finish'=>'Finish',
            'operator'=>'Operator',
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cast_date' => 'Cast Date',
            'act_date' => 'Act Date',
            'coil_number' => 'Coil Number',
            'shift' => 'Shift',
            'start' => 'Start',
            'finish' => 'Finish',
            'running_time' => 'Running Time',
            'actual_thickness' => 'Actual Thickness',
            'width' => 'Width',
            'actual_out' => 'Actual Out',
            'parent_id' => 'Parent ID',
            'coil_number_id' => 'Coil Number ID',
            'alloy_type' => 'Alloy Type',
            'alloy_code' => 'Alloy Code',
            'machine_id' => 'Machine ID',
            'machine_code' => 'Machine Code',
            'alloy' => 'Alloy',
            'datetime_start' => 'Datetime Start',
            'order_id' => 'Order ID',
            'datetime_finish' => 'Datetime Finish',
            'thickness' => 'Thickness',
            'actual_width' => 'Actual Width',
            'weight_processed' => 'Weight Processed',
            'plan_out' => 'Plan Out',
            'scrap_coil' => 'Scrap Coil',
            'scrap_drain' => 'Scrap Drain',
            'scrap_ba' => 'Scrap Ba',
            'scrap_qc' => 'Scrap Qc',
            'weight' => 'Weight',
            'strip_speed' => 'Strip Speed',
            'melting_temp' => 'Melting Temp',
            'holding_temp' => 'Holding Temp',
            'tap_out_temp' => 'Tap Out Temp',
            'alpur_temp' => 'Alpur Temp',
            'headbox_temp' => 'Headbox Temp',
            'pc' => 'Pc',
            'rpc' => 'Rpc',
            'grain_size' => 'Grain Size',
            'cff_no' => 'Cff No',
            'fe' => 'Fe',
            'si' => 'Si',
            'cu' => 'Cu',
            'mn' => 'Mn',
            'mg' => 'Mg',
            'zn' => 'Zn',
            'ti' => 'Ti',
            'al' => 'Al',
            'h2' => 'H2',
            'cls' => 'Cls',
            'li' => 'Li',
            'supervisor' => 'Supervisor',
            'operator' => 'Operator',
            'helper' => 'Helper',
            'helper2' => 'Helper2',
            'remark' => 'Remark',
            'qc_status' => 'Qc Status',
            'final_qc_status' => 'Final Qc Status',
            'status' => 'Status',
            'lme_price' => 'Lme Price',
            'kurs' => 'Kurs',
            'premium' => 'Premium',
            'lme_price_paid' => 'Lme Price Paid',
            'kurs_paid' => 'Kurs Paid',
            'premium_paid' => 'Premium Paid',
            'currency_code' => 'Currency Code',
            'next_machine' => 'Next Machine',
            'is_continue' => 'Is Continue',
            'is_planned' => 'Is Planned',
            'is_finish' => 'Is Finish',
            'is_processed' => 'Is Processed',
            'is_processed_date' => 'Is Processed Date',
            'supplied' => 'Supplied',
            'change_alloy' => 'Change Alloy',
            'alloy_original' => 'Alloy Original',
            'create_by' => 'Create By',
            'created' => 'Created',
            'modi_by' => 'Modi By',
            'modified' => 'Modified',
        ];
    }
}
