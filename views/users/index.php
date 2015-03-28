<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('user', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('user', 'Create User'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'email:email',
            'firstName',
            'lastName',
            ['attribute' => 'isActive', 'filter' => Helper::YesNoList(), 'format' => 'boolean'],
            ['attribute' => 'role', 'filter' => Helper::getRoles(), 'format' => 'role'],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
