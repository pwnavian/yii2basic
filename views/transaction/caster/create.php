<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Caster $model */

$this->title = 'Create Caster';
$this->params['breadcrumbs'][] = ['label' => 'Casters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="caster-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
