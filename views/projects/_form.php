<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use app\components\Helper;
use yii\helpers\ArrayHelper;
use app\models\Topic;

/* @var $this yii\web\View */
/* @var $model app\models\Project */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?php if (!$model->isNewRecord): ?>
        <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>
    <?php endif; ?>

    <?= $form->field($model, 'projectTopics')->checkboxList(Topic::getDropDownArray('id', 'title'), ['multiple' => true]) ?>

    <?= $form->field($model, 'isPublished')->dropDownList(Helper::YesNoList()) ?>

    <?= $form->field($model, 'countryId')->dropDownList(\app\models\Country::getDropDownArray('countryId', 'title'), ['id' => 'country-id', 'prompt' => Yii::t('app', 'Select...')]) ?>

    <?= $form->field($model, 'regionId')->dropDownList(\app\models\Region::getDropDownArray('regionId', 'title', ['countryId' => $model->countryId]), ['id' => 'region-id', 'prompt' => Yii::t('app', 'Select...')]) ?>

    <?= $form->field($model, 'cityId')->dropDownList(\app\models\City::getDropDownArray('cityId', 'title', ['regionId' => $model->regionId]), ['id' => 'city-id', 'prompt' => Yii::t('app', 'Select...')]) ?>

    <?= $form->field($model, 'shortDescription')->textarea() ?>

    <?= $form->field($model, 'description')->widget(CKEditor::className(), [
        'editorOptions' => ElFinder::ckeditorOptions(
            ['elfinder'], [
                'preset' => 'full',
            ]),
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
