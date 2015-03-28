<?php
use yii\helpers\Html;

/** @var $this \yii\web\View */
/** @var $model \app\models\Project */
?>

<div class="col-lg-4">
    <h2><?= $model->title ?></h2>

    <p><?= $model->shortDescription ?></p>

    <p>
        <?= Html::a(Yii::t('prject', 'View Project'), ['/project/view', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
    </p>
</div>