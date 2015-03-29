<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\components\Helper;

/** @var $this \yii\web\View */
/** @var $model \app\models\User */
?>
<div class="site-registration">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'type' => 'email']) ?>

    <?= $form->field($model, 'firstName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lastName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('user', 'Registration'),
            ['class' => 'btn btn-info']
        ) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>