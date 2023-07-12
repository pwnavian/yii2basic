<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Caster $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Casters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="caster-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'cast_date',
            'act_date',
            'coil_number',
            'shift',
            'start',
            'finish',
            'running_time:datetime',
            'actual_thickness',
            'width',
            'actual_out',
            'parent_id',
            'coil_number_id',
            'alloy_type',
            'alloy_code',
            'machine_id',
            'machine_code',
            'alloy',
            'datetime_start',
            'order_id',
            'datetime_finish',
            'thickness',
            'actual_width',
            'weight_processed',
            'plan_out',
            'scrap_coil',
            'scrap_drain',
            'scrap_ba',
            'scrap_qc',
            'weight',
            'strip_speed',
            'melting_temp',
            'holding_temp',
            'tap_out_temp',
            'alpur_temp',
            'headbox_temp',
            'pc',
            'rpc',
            'grain_size',
            'cff_no',
            'fe',
            'si',
            'cu',
            'mn',
            'mg',
            'zn',
            'ti',
            'al',
            'h2',
            'cls',
            'li',
            'supervisor',
            'operator',
            'helper',
            'helper2',
            'remark:ntext',
            'qc_status',
            'final_qc_status',
            'status',
            'lme_price',
            'kurs',
            'premium',
            'lme_price_paid',
            'kurs_paid',
            'premium_paid',
            'currency_code',
            'next_machine',
            'is_continue',
            'is_planned',
            'is_finish',
            'is_processed',
            'is_processed_date',
            'supplied',
            'change_alloy',
            'alloy_original',
            'create_by',
            'created',
            'modi_by',
            'modified',
        ],
    ]) ?>

</div>
