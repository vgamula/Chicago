<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\News */

$this->title = Yii::t('news', 'Update {modelClass}: ', [
    'modelClass' => 'News',
]) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('project', 'Projects'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->project->title, 'url' => ['/projects/view', 'id' => $model->projectId]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'News List'), 'url' => ['/projects/view', 'id' => $model->projectId]];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('news', 'Update');
?>
<div class="news-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
