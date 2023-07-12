<?php

use kartik\tabs\TabsX;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use sdelfi\datatables\DataTables;

/** @var yii\web\View $this */
/** @var app\models\CasterSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
$style = <<<CSS
div.dt-bootstrap4{
  position: relative !important;
  clear: both !important;
}
CSS;
$this->registerCss($style);
$this->title = 'Casters';
$this->params['breadcrumbs'][] = $this->title;

$content1 = Datatables::widget([
    'dataProvider' => $dataProvider,
    'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],
    'clientOptions'=>[
        'scrollX' => '200px',
        'scrollY' => '400px',
        'scrollCollapse' => true,
    ],
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'act_date',
			'shift',
            'coil_number',
            'alloy_code',
            'start',
            'finish',
            'running_time',
            'actual_thickness',
            'actual_width',
            'actual_out',
            'plan_out',
            'scrap_coil',
            'scrap_drain',
            [
				'attribute'=>'qc_status',
				'value'=>function ($model) {
					$status='';
					if($model->qc_status=='P'){
						$status = 'CONTINUE';
					}
					else if($model->qc_status=='H'){
						$status = 'HOLD';
					}
					else if($model->qc_status=='O'){
						$status = 'OTHER';
					}
					else if($model->qc_status=='K'){
						$status = 'KONSES';
					}
					else if($model->qc_status=='S'){
						$status = 'SCRAP';
					}
					return $status;
				},
			],
			'weight',
            'strip_speed',
            'supervisor',
            'helper',
            'helper2',
            'operator',
            'pc',
            'rpc',
            'cff_no',
            'melting_temp',
            'holding_temp',
            'alpur_temp',
            'headbox_temp',
			[
			'label' => 'Is Finish?',
			'format' => 'raw',
			'value' => function($model, $key, $index, $column){return $model->is_finish == 0 ? 'CONTINUE' : 'FINISH';}
			],
        [
            'class' => ActionColumn::class,
            'header'=>'&nbsp;Action&nbsp;',
            'template'=>'{finish} {view} {update} {delete}',
            'buttons' =>[
                'finish' => function ($url, $model, $key) {
                    return Html::a('<span class="bi-flag-fill"></span>', Url::to(['transaction/caster/finish?id='.$model->id]), [
                    'title' => Yii::t('yii', 'Finish Coil No: '.(!empty($model->field_info) ? ActionColumn::createTooltip($model) : ''))]);
                },
                // 'view' => function ($url, $model, $key) {
                //     return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', Url::to(['transaction/caster/view?id='.$model->id]), [
                //     'title' => Yii::t('yii', 'View')]);
                // },
                // 'update' => function ($url, $model, $key) {
                //     return Html::a('<span class="glyphicon glyphicon-pencil"></span>', Url::to(['transaction/caster/update2?id='.$model->id]), [
                //     'title' => Yii::t('yii', 'Update')]);
                // },
                // 'delete' => function ($url, $model, $key) {
                //     return Html::a('<span class="glyphicon glyphicon-trash"></span>', Url::to(['transaction/caster/delete?id='.$model->id]), [
                //     'title' => Yii::t('yii', 'Delete'),
                //     'data-confirm' => Yii::t('yii', 'Are you sure to delete this item?'),
                //     'data-method' => 'post',
                //     ]);
                // }
            ],
            // 'urlCreator' => function ($action, $model, $key, $index, $column) {
                
            //     return Url::toRoute([$action, 'id' => $model->id]);
            //  }
        ],
    ],
]); 

$items = [
    [
        'options'=> ['id' => 'tab-dpr'],
        'label'=>'<i class="fa fa-fire"></i>DPR',
        'content' => $content1
    ],
];
?>
<div class="caster-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Caster', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(['id' => 'caster', 'enablePushState'=>false, 'enableReplaceState'=>false, 'timeout' => false]); ?>
    
    <?php
    echo  TabsX::widget([
    'id'=>'MyTabs',
	'items'=>$items,
    'options'=> ['tab'=>'div'],
    'itemOptions'=> ['tab'=>'div'],
	//'position'=>TabsX::POS_ABOVE,
	//'bordered'=>true,
    'encodeLabels'=>false
    ]);
    Pjax::end();
    ?>


</div>
