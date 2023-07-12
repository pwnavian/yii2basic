<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use kartik\builder\TabularForm;
use yii\helpers\Url;
use yii\bootstrap4\Modal;

/* @var $this yii\web\View */
/* @var $model app\models\Melting */
/* @var $form yii\widgets\ActiveForm */
Modal::begin([
				'id'=>'modal',
				'title'=>'PPIC Plan',
				'size'=>'modal-lg'
		]);
		echo "<div id='modalContent'></div>";

Modal::end();

$server = Yii::$app->request->hostInfo;
$base = Yii::$app->homeUrl;

$script = <<< JS
$('#modalButton').click(function (){
		$('#modal').modal('show')
		.find('#modalContent')
		.load($(this).attr('value'));
	});

$('#save').click(function(e){
// $('#w0').submit(function (e){


	var coil_number = $("#caster-coil_number").val();

  if(coil_number == ''){
	  alert("Coil Number belum dipilih! Silahkan pilih coil number terlebih dahulu.");
	  e.preventDefault();
		e.stopImmediatePropagation();
		return false;
  }

	e.preventDefault();
  e.stopImmediatePropagation();
  checkMaxScrap(e);

});

function checkMaxScrap(e){
	var urlPost = "$server"+""+"$base"+"general/check-max-scrap";
	// var urlPost = "$server"+""+"$base"+"general/save-data-prob-ncrv2";
	var queryString = $('#csta').serializeArray();

	$.ajax({
					url: urlPost,
					type: 'post',
					dataType:"HTML",
					data: queryString,
					success: function (data) {

						// console.log(data);

						var x = JSON.parse( data );

						if(x.code != 0){
							alert(x.text);
							return false;

						}else{
							$("#csta").submit();
						}


					},
					error: function (xhr, ajaxOptions, thrownError) {

					}
			 });


}

JS;



$this->registerJs($script);
// $this->registerJsFile(Url::base() .'/views/transaction/caster/js/caster.js');
?>
<div class="col-lg-12">
    <?php if(Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger" role="alert">
            <?= Yii::$app->session->getFlash('error') ?>
        </div>
    <?php elseif(Yii::$app->session->hasFlash('success')): ?>
		<div class="alert alert-success" role="alert">
            <?= Yii::$app->session->getFlash('success') ?>
        </div>
	<?php else : ?>
    <?php endif; ?>
	</div>
<div class="col-lg-12">
	
<?php
$form = ActiveForm::begin(['id' => "csta"]);

echo "<input type='hidden' id='jenMachine' name='jenMachine' value='CSTA'>";


 echo FormGrid::widget([
		'model'=>$model,
		'form'=>$form,

		'autoGenerateColumns'=>true,
			'rows'=>[
				[
				'columns'=>2,
				// 'columnSize' => Form::SIZE_TINY,
				'autoGenerateColumns'=>false,
				'attributes'=>[
					'coil_number'=>[
						'type'=>Form::INPUT_RAW,
						'value'=>'<div class="mb-3 highlight-addon field-caster-coil_number"><label class="form-label has-star" for="basic-url">Coil No.</label>
									<div class="input-group">
								  <input type="text" id="caster-coil_number" class="form-control" name="Caster[coil_number]" value="'.($model->coil_number ?: '').'" readonly=true placeholder="Search for...">
								  <span class="input-group-btn">
									'.Html::button('Get Data', ['value' => Url::to(['transaction/caster/lov2']), 'title' => 'Get Data', 'class' => 'btn btn-success', 'id'=>'modalButton']).'
								  </span>
								</div></div>'
					],
					'machine_code'=>[
						'type'=>Form::INPUT_WIDGET,
						'widgetClass' => \kartik\widgets\Select2::className(),
						'options'=>[
							'data' => \Yii::$app->General->getMachine(mc:'CSTA'),
							'pluginOptions' => [
								'allowClear' => true
								],
							],
						],
					]
				],
				[
				'contentBefore'=>'<legend class="text-info"><big>Program PPIC</big></legend>',
				'columns'=>4,
				'autoGenerateColumns'=>false,
				'attributes'=>[       // 2 column layout

					'alloy_type'=>[
						'type'=>Form::INPUT_TEXT,
						'options'=>[
							'readonly'=>true
						]
					],
					// 'alloy_type'=>[
					// 	'type'=>Form::INPUT_WIDGET,
					// 	'widgetClass' => \kartik\widgets\Select2::className(),
					// 	'options'=>[
					// 		'data' => $listAlloyType,
					// 		'pluginOptions' => [
					// 			'allowClear' => true
					// 			],
					// 		// 'pluginEvents'=>[
					// 				// "change" => "function() { testme('".$server."', '".$base."', this.value); }",
					// 			// ]
					// 		],
					// ],
					'alloy_code'=>[
						'type'=>Form::INPUT_TEXT,
						'options'=>[
							'readonly'=>true
						]
					],
					'thickness'=>[
						'type'=>Form::INPUT_TEXT,
						'options'=>[

						],
						'hint'=>'Thickness (micron)'
					],
					'width'=>[
						'type'=>Form::INPUT_TEXT,
						'options'=>[
							'readonly'=>true
						],
						'hint'=>'Width (mm.)'
					],
					'order_id'=>[
						'type'=>Form::INPUT_HIDDEN,
						'label'=>false,
						'options'=>[
						],
					],
					],
				],
				[
				'contentBefore'=>'<legend class="text-info"><big>DPR</big></legend>',
				'attributes'=>[
					'shift'=>[
						'type'=>Form::INPUT_WIDGET,
						'widgetClass' => \kartik\widgets\Select2::className(),
						'options'=>[
							'data' => \Yii::$app->General->getShift(),
							'pluginOptions' => [
								'allowClear' => true
								],
							],
					],
					'cast_date'=>[
						'type'=>Form::INPUT_WIDGET,
						'widgetClass' => \kartik\widgets\DatePicker::className(),
						'options'=>[
							'name' => 'start_dt',
							'options'=>[],
							'pluginOptions' => [
								'autoclose'=>true,
								'format' => 'dd-M-yyyy'
								]
							]
						],
					'start'=>[
						'type'=>Form::INPUT_WIDGET,
						'widgetClass' => \kartik\widgets\TimePicker::className(),
						'options'=>[
							'name' => 'start',
							'options' => ['placeholder' => '...'],
							'pluginOptions' => [
								'autoclose'=>true,
								'showSeconds' => false,
								'showMeridian' => false,
								'format' => 'hh:ii'
								]
							],
						'hint'=>'Masukkan start casting'
						],
					'finish'=>[
						'type'=>Form::INPUT_WIDGET,
						'widgetClass' => \kartik\widgets\TimePicker::className(),
						'options'=>[
							'name' => 'finish',
							'options' => ['placeholder' => '...'],
							'pluginOptions' => [
								'autoclose'=>true,
								'showSeconds' => false,
								'showMeridian' => false,
								'format' => 'hh:ii'
								],
							],
						'hint'=>'Masukkan finish casting'
						],
					]
				],

				[
				'columns'=>4,
				'autoGenerateColumns'=>false,
				'attributes'=>[
					'actual_thickness' => [
						'type'=>Form::INPUT_WIDGET,
						'widgetClass' => \yii\widgets\MaskedInput::className(),
						'options' => [
							'clientOptions' => [
							'alias' => 'integer',
							'radixPoint' => ',',
							'groupSeparator' => '.',
							'autoGroup' => true,
							'removeMaskOnSubmit' => true
							]
						],
						'hint'=>'Thickness (micron)'
					],
					'actual_out' => [
						'type'=>Form::INPUT_WIDGET,
						'widgetClass' => \yii\widgets\MaskedInput::className(),
						'options' => [
							'clientOptions' => [
							'alias' => 'integer',
							'radixPoint' => ',',
							'groupSeparator' => '.',
							'autoGroup' => true,
							'removeMaskOnSubmit' => true
							]
						],
						'hint'=>'Actual Out (Kg.)'
					],
					'scrap_coil' => [
						'type'=>Form::INPUT_WIDGET,
						'widgetClass' => \yii\widgets\MaskedInput::className(),
						'options' => [
							'clientOptions' => [
							'alias' => 'integer',
							'radixPoint' => ',',
							'groupSeparator' => '.',
							'autoGroup' => true,
							'removeMaskOnSubmit' => true
							]
						],
						'hint'=>'Scrap Coil Out'
					],
					'scrap_drain' => [
						'type'=>Form::INPUT_WIDGET,
						'widgetClass' => \yii\widgets\MaskedInput::className(),
						'options' => [
							'clientOptions' => [
							'alias' => 'integer',
							'radixPoint' => ',',
							'groupSeparator' => '.',
							'autoGroup' => true,
							'removeMaskOnSubmit' => true
							]
						],
						'hint'=>'Scrap Drain Out'
					],
					'pc' => [
						'type'=>Form::INPUT_WIDGET,
						'widgetClass' => \yii\widgets\MaskedInput::className(),
						'options' => [
							'clientOptions' => [
							'alias' => 'decimal',
							'radixPoint' => ',',
							'groupSeparator' => '.',
							'autoGroup' => true,
							'removeMaskOnSubmit' => true
							]
						],
						'hint'=>'PC. (%)'
					],
					'rpc' => [
						'type'=>Form::INPUT_WIDGET,
						'widgetClass' => \yii\widgets\MaskedInput::className(),
						'options' => [
							'clientOptions' => [
							'alias' => 'decimal',
							'radixPoint' => ',',
							'groupSeparator' => '.',
							'autoGroup' => true,
							'removeMaskOnSubmit' => true
							]
						],
						'hint'=>'RPC (%)'
					],
					'cff_no' => [
						'type'=>Form::INPUT_WIDGET,
						'widgetClass' => \yii\widgets\MaskedInput::className(),
						'options' => [
							'clientOptions' => [
							'alias' => 'decimal',
							'autoGroup' => true,
							'removeMaskOnSubmit' => true
							]
						],
						'hint'=>'Masukkan No. cff'
					],

				],
			],
			// [
				// 'contentBefore'=>'<legend class="text-info"><medium>Temperature (°C)</medium></legend>',
				// 'attributes'=>[
				// 'melting_temp' => [
						// 'type'=>Form::INPUT_WIDGET,
						// 'widgetClass' => \yii\widgets\MaskedInput::className(),
						// 'options' => [
							// 'clientOptions' => [
							// 'alias' => 'decimal',
							// 'radixPoint' => ',',
							// 'groupSeparator' => '.',
							// 'autoGroup' => true,
							// 'removeMaskOnSubmit' => true
							// ]
						// ],
						// 'hint'=>'Melting Temp'
					// ],
				// 'holding_temp' => [
						// 'type'=>Form::INPUT_WIDGET,
						// 'widgetClass' => \yii\widgets\MaskedInput::className(),
						// 'options' => [
							// 'clientOptions' => [
							// 'alias' => 'decimal',
							// 'radixPoint' => ',',
							// 'groupSeparator' => '.',
							// 'autoGroup' => true,
							// 'removeMaskOnSubmit' => true
							// ]
						// ],
						// 'hint'=>'Hoding / Tap Out (Roof)'
					// ],
				// 'alpur_temp' => [
						// 'type'=>Form::INPUT_WIDGET,
						// 'widgetClass' => \yii\widgets\MaskedInput::className(),
						// 'options' => [
							// 'clientOptions' => [
							// 'alias' => 'decimal',
							// 'radixPoint' => ',',
							// 'groupSeparator' => '.',
							// 'autoGroup' => true,
							// 'removeMaskOnSubmit' => true
							// ]
						// ],
						// 'hint'=>'Alpur / CFF'
					// ],
				// 'headbox_temp' => [
						// 'type'=>Form::INPUT_WIDGET,
						// 'widgetClass' => \yii\widgets\MaskedInput::className(),
						// 'options' => [
							// 'clientOptions' => [
							// 'alias' => 'decimal',
							// 'radixPoint' => ',',
							// 'groupSeparator' => '.',
							// 'autoGroup' => true,
							// 'removeMaskOnSubmit' => true
							// ]
						// ],
						// 'hint'=>'Head Box Temp (Roof)'
					// ],
			// ]
			// ],
			[
				'attributes'=>[
					'remark' => ['type'=>Form::INPUT_TEXTAREA, 'options'=>['placeholder'=>'...'],'hint'=>'Tambahkan remark jika ada'],
					'is_finish' => [
						'type'=>Form::INPUT_WIDGET,
						'widgetClass' => \kartik\widgets\Select2::className(),
						'options'=>[
							'data' => [1=>'Finish',0=>'Continue'],
							'pluginOptions' => [
								'allowClear' => true
								],
							],
					],// 2 column layout
				]
			],
		]

	]);


	?>
	<div class="row">
	<?= $this->render('/transaction/general/personil', ['form'=>$form, 'model'=>$model]) ?>
	<?= Html::submitButton($model->isNewRecord ? 'Save' : 'Update', ['id' => 'save' , 'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	
	</div>
 <?php

 ActiveForm::end(); ?>
</div>
