<?php
use yii\bootstrap5\Breadcrumbs;
use app\widgets\Alert;
?>
<div class="container">
    <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
</div>