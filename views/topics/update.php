<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Topic */

$this->title = Yii::t('topic', 'Update {modelClass}: ', [
    'modelClass' => 'Topic',
]) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('topic', 'Topics'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('topic', 'Update');
?>
<div class="topic-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
