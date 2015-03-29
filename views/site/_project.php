<?php
use yii\helpers\Html;

/** @var $this \yii\web\View */
/** @var $model \app\models\Project */
?>

<div class="col-lg-4 table-bordered">
    <h2><?= $model->title ?></h2>

    <p><?= $model->shortDescription ?></p>

    <p>
        <?= Html::a(Yii::t('project', 'View Project'), ['/site/view', 'slug' => $model->alias], ['class' => 'btn btn-default']) ?>
    </p>
</div>