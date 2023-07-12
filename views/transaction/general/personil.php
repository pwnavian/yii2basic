
	<div class="col-lg-3">
	<?= $form->field($model, 'operator')->widget(kartik\widgets\Select2::classname(), [
				'data' => \Yii::$app->General->getOperator($model->machineName()),
				'options' => ['placeholder' => '...', 'value'=>(isset($operator_nama) && (isset($action) && $action <> 'update') ? $operator_nama : $model->operator )],
				'pluginOptions' => [
					'allowClear' => true
				],
			]); ?>
	</div>
	<div class="col-lg-3">
	<?= $form->field($model, 'supervisor')->widget(kartik\widgets\Select2::classname(), [
				'data' => \Yii::$app->General->getSupervisor(),
				'options' => ['placeholder' => '...'],
				'pluginOptions' => [
					'allowClear' => true
				],
			]); ?>
	</div>
	<div class="col-lg-3">
	<?= $form->field($model, 'helper')->widget(kartik\widgets\Select2::classname(), [
				'data' => \Yii::$app->General->getHelper(),
				'options' => ['placeholder' => '...'],
				'pluginOptions' => [
					'allowClear' => true
				],
			]); ?>
	</div>
	<div class="col-lg-3">
	<?= $form->field($model, 'helper2')->widget(kartik\widgets\Select2::classname(), [
				'data' => \Yii::$app->General->getHelper(),
				'options' => ['placeholder' => '...'],
				'pluginOptions' => [
					'allowClear' => true
				],
			]); ?>
	</div>