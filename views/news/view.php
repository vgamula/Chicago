<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\News */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('project', 'Projects'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->project->title, 'url' => ['/projects/view', 'id' => $model->projectId]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'News List'), 'url' => ['/projects/view', 'id' => $model->projectId]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if (!$model->isSent): ?>
            <?= Html::a(Yii::t('news', 'Send'), ['send', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
            <?= Html::a(Yii::t('news', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php endif ?>

        <?= Html::a(Yii::t('news', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('project', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>

        <?= Html::a(Yii::t('project', 'View project'), ['/projects/view', 'id' => $model->id], [
            'class' => 'btn btn-info',
        ]) ?> 
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
            'updatedAt:datetime',
            'isSent:boolean',
            'description:html',
        ],
    ]) ?>

</div>
