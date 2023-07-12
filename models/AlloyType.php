<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ctm_dpr_alloy_type_tab".
 *
 * @property string $id
 * @property string|null $alloy_type
 * @property int|null $create_by
 * @property string|null $created
 * @property int|null $modi_by
 * @property string|null $modified
 *
 * @property CtmDprAlloyTab[] $ctmDprAlloyTabs
 */
class AlloyType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ctm_dpr_alloy_type_tab';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['create_by', 'modi_by'], 'integer'],
            [['created', 'modified'], 'safe'],
            [['id'], 'string', 'max' => 36],
            [['alloy_type'], 'string', 'max' => 10],
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
            'alloy_type' => 'Alloy Type',
            'create_by' => 'Create By',
            'created' => 'Created',
            'modi_by' => 'Modi By',
            'modified' => 'Modified',
        ];
    }

    /**
     * Gets query for [[CtmDprAlloyTabs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCtmDprAlloyTabs()
    {
        return $this->hasMany(CtmDprAlloyTab::class, ['alloy_type_id' => 'id']);
    }
}
