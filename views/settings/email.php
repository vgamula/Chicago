<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */

//@todo add breadcrumbs
?>
<div class="settings-email">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'type' => 'email']) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('user', 'Save'),['class' =>'btn btn-info']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>