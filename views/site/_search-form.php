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

    <?= $form->field($model, 'projectTopics')->inline()->checkboxList(Topic::getDropDownArray('id', 'title')) ?>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'countryId')->dropDownList(\app\models\Country::getDropDownArray('countryId', 'title'), ['id' => 'country-id', 'prompt' => Yii::t('app', 'Select...')]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'regionId')->dropDownList(\app\models\Region::getDropDownArray('regionId', 'title', ['countryId' => $model->countryId]), ['id' => 'region-id', 'prompt' => Yii::t('app', 'Select...')]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'cityId')->dropDownList(\app\models\City::getDropDownArray('cityId', 'title', ['regionId' => $model->regionId]), ['id' => 'city-id', 'prompt' => Yii::t('app', 'Select...')]) ?>
        </div>
    </div>

    <?= Html::submitButton(
        '<span class="glyphicon glyphicon-search" aria-hidden="true"></span> ' . Yii::t('app', 'Find'),
        ['class' => 'btn btn-success']) ?>
    <?php $form->end() ?>
</div>