<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ctm_dpr_machine_tab".
 *
 * @property string $id
 * @property string|null $machine_code
 * @property string|null $machine_group_code
 * @property string|null $machine_group_name
 * @property int|null $urut
 * @property string|null $machine_name
 * @property string|null $model_name
 * @property string $category_id
 * @property string|null $category_kode
 * @property int|null $qty_phase
 * @property string|null $status
 * @property float|null $productivity_target
 * @property int|null $create_by
 * @property string|null $created
 * @property int|null $modi_by
 * @property string|null $modified
 */
class Machine extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ctm_dpr_machine_tab';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'category_id'], 'required'],
            [['urut', 'qty_phase', 'create_by', 'modi_by'], 'integer'],
            [['productivity_target'], 'number'],
            [['created', 'modified'], 'safe'],
            [['id', 'category_id'], 'string', 'max' => 36],
            [['machine_code', 'machine_group_code', 'category_kode'], 'string', 'max' => 10],
            [['machine_group_name'], 'string', 'max' => 20],
            [['machine_name'], 'string', 'max' => 50],
            [['model_name'], 'string', 'max' => 25],
            [['status'], 'string', 'max' => 1],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'machine_code' => 'Machine Code',
            'machine_group_code' => 'Machine Group Code',
            'machine_group_name' => 'Machine Group Name',
            'urut' => 'Urut',
            'machine_name' => 'Machine Name',
            'model_name' => 'Model Name',
            'category_id' => 'Category ID',
            'category_kode' => 'Category Kode',
            'qty_phase' => 'Qty Phase',
            'status' => 'Status',
            'productivity_target' => 'Productivity Target',
            'create_by' => 'Create By',
            'created' => 'Created',
            'modi_by' => 'Modi By',
            'modified' => 'Modified',
        ];
    }
}
