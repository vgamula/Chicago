<?php
/** @var $this \yii\web\View */
/** @var $model \app\models\News */
?>
<div class="item-news">
    <div class="title">
        <h2><?= $model->title ?></h2>
        <span><?= Yii::$app->formatter->asDatetime($model->updatedAt) ?></span>
    </div>
    <div>
        <?= $model->description ?>
    </div>
</div>