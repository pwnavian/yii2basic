<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Caster $model */

$this->title = 'Update Caster: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Casters', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="caster-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
