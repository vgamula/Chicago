<?php

namespace app\controllers;

use app\models\User;
use Yii;

class SettingsController extends \yii\web\Controller
{
    public function actionEmail()
    {
        $model = $this->findModel();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //@TODO set flash
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionPassword()
    {
        $model = $this->findModel();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //@TODO set flash
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionSubscription()
    {
        return $this->render('subscription');
    }

    /**
     * @return User
     */
    protected function findModel()
    {
        return User::findOne(Yii::$app->user->id);
    }

}
