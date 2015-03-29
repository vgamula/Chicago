<?php
/** @var $this \yii\web\View */
/** @var $model \app\models\Project */
$this->title = $model->title;
?>
<div class="site-view">
    <div class="project">
        <h1><?= $model->title ?></h1>
        <?= $model->description ?>
    </div>
    <div>
    </div>
    <div class="news">
        <h2><?= Yii::t('app', 'News List') ?></h2>
        <?= \yii\widgets\ListView::widget([
            'dataProvider' => $model->getNewsProvider(),
            'itemView' => '_news',
        ]) ?>
    </div>
</div>