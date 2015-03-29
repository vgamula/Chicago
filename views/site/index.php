<?php
/* @var $this yii\web\View */
/* @var $dataProvider \yii\data\ActiveDataProvider */
$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div>
        <?= $this->render('_search-form',['model'=>new \app\models\ProjectSearch()]) ?>
    </div>

    <div class="body-content">

        <div class="row">
            <?= \yii\widgets\ListView::widget([
                'layout' => '{items}',
                'dataProvider' => $dataProvider,
                'itemView' => '_project',
            ]) ?>
        </div>

    </div>
</div>
