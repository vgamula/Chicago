<?php

use app\models\News;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Project */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('project', 'Projects'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('project', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('project', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('project', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a(Yii::t('project', 'View on site'), ['/site/view', 'slug' => $model->alias], ['class' => 'btn btn-default']) ?>
        <?= Html::a(Yii::t('project', 'Add News'), ['/news/create', 'projectId' => $model->id], ['class' => 'btn btn-success']) ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
            'isPublished:boolean',
            'createdAt:datetime',
            'updatedAt:datetime',
        ],
    ]) ?>

    <div>
        <h2><?= Yii::t('app', 'News List') ?></h2>
        <?= \yii\grid\GridView::widget([

            'dataProvider' => $model->getNewsProvider(),
            'columns' => [
                ['class' => \yii\grid\SerialColumn::className()],
                'title',
                'isSent:boolean',
                [
                    'class' => \yii\grid\ActionColumn::className(),
                    'controller' => 'news',
                    'template' => '{view} {update} {delete} {send}',
                    'buttons' => [
                        'send' => function ($url, News $model) {
                            return $model->isSent ? '' : Html::a('<span class="glyphicon glyphicon-envelope"></span>',
                                ['/news/send', 'id' => $model->id],
                                ['title' => Yii::t('news', 'Send'),]
                            );
                        },
                        'update' => function ($url, $model, $key) {
                            return $model->isSent ? '' : Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                'title' => Yii::t('yii', 'Update'),
                                'data-pjax' => '0',
                            ]);
                        }
                    ]
                ],
            ],
        ]) ?>
    </div>

</div>
