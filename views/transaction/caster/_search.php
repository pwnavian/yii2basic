<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\CasterSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="caster-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'cast_date') ?>

    <?= $form->field($model, 'act_date') ?>

    <?= $form->field($model, 'coil_number') ?>

    <?= $form->field($model, 'shift') ?>

    <?php // echo $form->field($model, 'start') ?>

    <?php // echo $form->field($model, 'finish') ?>

    <?php // echo $form->field($model, 'running_time') ?>

    <?php // echo $form->field($model, 'actual_thickness') ?>

    <?php // echo $form->field($model, 'width') ?>

    <?php // echo $form->field($model, 'actual_out') ?>

    <?php // echo $form->field($model, 'parent_id') ?>

    <?php // echo $form->field($model, 'coil_number_id') ?>

    <?php // echo $form->field($model, 'alloy_type') ?>

    <?php // echo $form->field($model, 'alloy_code') ?>

    <?php // echo $form->field($model, 'machine_id') ?>

    <?php // echo $form->field($model, 'machine_code') ?>

    <?php // echo $form->field($model, 'alloy') ?>

    <?php // echo $form->field($model, 'datetime_start') ?>

    <?php // echo $form->field($model, 'order_id') ?>

    <?php // echo $form->field($model, 'datetime_finish') ?>

    <?php // echo $form->field($model, 'thickness') ?>

    <?php // echo $form->field($model, 'actual_width') ?>

    <?php // echo $form->field($model, 'weight_processed') ?>

    <?php // echo $form->field($model, 'plan_out') ?>

    <?php // echo $form->field($model, 'scrap_coil') ?>

    <?php // echo $form->field($model, 'scrap_drain') ?>

    <?php // echo $form->field($model, 'scrap_ba') ?>

    <?php // echo $form->field($model, 'scrap_qc') ?>

    <?php // echo $form->field($model, 'weight') ?>

    <?php // echo $form->field($model, 'strip_speed') ?>

    <?php // echo $form->field($model, 'melting_temp') ?>

    <?php // echo $form->field($model, 'holding_temp') ?>

    <?php // echo $form->field($model, 'tap_out_temp') ?>

    <?php // echo $form->field($model, 'alpur_temp') ?>

    <?php // echo $form->field($model, 'headbox_temp') ?>

    <?php // echo $form->field($model, 'pc') ?>

    <?php // echo $form->field($model, 'rpc') ?>

    <?php // echo $form->field($model, 'grain_size') ?>

    <?php // echo $form->field($model, 'cff_no') ?>

    <?php // echo $form->field($model, 'fe') ?>

    <?php // echo $form->field($model, 'si') ?>

    <?php // echo $form->field($model, 'cu') ?>

    <?php // echo $form->field($model, 'mn') ?>

    <?php // echo $form->field($model, 'mg') ?>

    <?php // echo $form->field($model, 'zn') ?>

    <?php // echo $form->field($model, 'ti') ?>

    <?php // echo $form->field($model, 'al') ?>

    <?php // echo $form->field($model, 'h2') ?>

    <?php // echo $form->field($model, 'cls') ?>

    <?php // echo $form->field($model, 'li') ?>

    <?php // echo $form->field($model, 'supervisor') ?>

    <?php // echo $form->field($model, 'operator') ?>

    <?php // echo $form->field($model, 'helper') ?>

    <?php // echo $form->field($model, 'helper2') ?>

    <?php // echo $form->field($model, 'remark') ?>

    <?php // echo $form->field($model, 'qc_status') ?>

    <?php // echo $form->field($model, 'final_qc_status') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'lme_price') ?>

    <?php // echo $form->field($model, 'kurs') ?>

    <?php // echo $form->field($model, 'premium') ?>

    <?php // echo $form->field($model, 'lme_price_paid') ?>

    <?php // echo $form->field($model, 'kurs_paid') ?>

    <?php // echo $form->field($model, 'premium_paid') ?>

    <?php // echo $form->field($model, 'currency_code') ?>

    <?php // echo $form->field($model, 'next_machine') ?>

    <?php // echo $form->field($model, 'is_continue') ?>

    <?php // echo $form->field($model, 'is_planned') ?>

    <?php // echo $form->field($model, 'is_finish') ?>

    <?php // echo $form->field($model, 'is_processed') ?>

    <?php // echo $form->field($model, 'is_processed_date') ?>

    <?php // echo $form->field($model, 'supplied') ?>

    <?php // echo $form->field($model, 'change_alloy') ?>

    <?php // echo $form->field($model, 'alloy_original') ?>

    <?php // echo $form->field($model, 'create_by') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'modi_by') ?>

    <?php // echo $form->field($model, 'modified') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
