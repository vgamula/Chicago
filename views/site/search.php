<?php
/** @var $this \yii\web\View */
/** @var $model \app\models\ProjectSearch */
/** @var $dataProvider \yii\data\ActiveDataProvider */
$this->title = Yii::t('app','Search Result');
?>
<div class="site-search">

    <div>
        <?= $this->render('_search-form', ['model' => $model]) ?>
    </div>
    <div class="projects-list">
        <?= \yii\widgets\ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_project',
        ]) ?>
    </div>
</div>