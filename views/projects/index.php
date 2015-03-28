<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('project', 'Projects');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('project', 'Create Project'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'title',
            [
                'attribute' => 'alias',
                'format' => 'raw',
                'value' => function (\app\models\Project $model) {
                    return Html::a($model->alias, ['/site/view', 'slug' => $model->alias]);
                }
            ],
            'isPublished:boolean',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
