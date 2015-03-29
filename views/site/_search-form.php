<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;
use app\models\Topic;

/** @var $this \yii\web\View */
/** @var $model \app\models\ProjectSearch */
?>
<div class="main-search">
    <?php $form = ActiveForm::begin(['id' => 'search-form', 'action' => Url::to(['/site/search']), 'method' => 'get']) ?>

    <div class="text-center">
        <h2><?= Yii::t('app', 'Find projects') ?></h2>
    </div>
    <?= $form->field($model, 'title')->label(Yii::t('search', 'Title')) ?>

    <?= $form->field($model, 'projectTopics')->checkboxList(Topic::getDropDownArray('id', 'title')) ?>


    <?= Html::submitButton(
        '<span class="glyphicon glyphicon-search" aria-hidden="true"></span> ' . Yii::t('app', 'Find'),
        ['class' => 'btn btn-success']) ?>
    <?php $form->end() ?>
</div>