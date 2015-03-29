<?php
use yii\helpers\Html;

/** @var $this \yii\web\View */
/** @var $model \app\models\Project */
$this->title = $model->title;
?>
<div class="site-view">
    <div class="project">
        <h1><?= $model->title ?></h1>
        <?= $model->description ?>
        <div>
            <span class="label label-info"><?= $model->country->title ?></span>
            <span class="label label-info"><?= $model->region->title ?></span>
            <span class="label label-info"><?= $model->city->title ?></span>
        </div>
        <div>
            <?php foreach($model->topics as $topic): ?>
                <span class="label label-success"><?= $topic->title ?></span>
            <?php endforeach ?>
        </div>
    </div>
    </div>
    <div class="margin-top-20">
        <?php if (!Yii::$app->user->isGuest): ?>
            <?php if (!$model->hasSubscriber(Yii::$app->user->identity)): ?>
                <?= Html::a(Yii::t('app', 'Subscribe'), ['/site/subscribe', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
            <?php else: ?>
                <?= Html::a(Yii::t('app', 'Unsubscribe'), ['/site/unsubscribe', 'id' => $model->id], ['class' => 'btn btn-danger']) ?>
            <?php endif ?>
        <?php endif ?>
    </div>
    <div class="news">
        <h2><?= Yii::t('app', 'News List') ?></h2>
        <?= \yii\widgets\ListView::widget([
            'dataProvider' => $model->getNewsProvider(),
            'itemView' => '_news',
        ]) ?>
    </div>
</div>