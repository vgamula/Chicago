<?php
use yii\helpers\Html;

/** @var $this \yii\web\View */
/** @var $model \app\models\Project */
?>

<div class="col-lg-4 table-bordered">
    <h2><?= $model->title ?></h2>

    <div>
        <?php foreach($model->topics as $topic): ?>
            <span class="label label-success"><?= $topic->title ?></span>
        <?php endforeach ?>
    </div>
    <p><?= $model->shortDescription ?></p>

    <p>
        <?= Html::a(Yii::t('project', 'View Project'), ['/site/view', 'slug' => $model->alias], ['class' => 'btn btn-default']) ?>
    </p>
</div>