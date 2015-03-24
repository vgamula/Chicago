<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('user', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('user', 'Create User'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'email:email',
            'firstName',
            'middleName',
            'lastName',
            // 'status',
            // 'role',
            // 'passwordHash',
            // 'passwordResetToken',
            // 'passwordResetExpire',
            // 'createdAt',
            // 'updatedAt',
            // 'emailConfirmToken:email',
            // 'emailConfirmed:email',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
