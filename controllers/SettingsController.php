<?php

namespace app\controllers;

class SettingsController extends \yii\web\Controller
{
    public function actionEmail()
    {
        return $this->render('email');
    }

    public function actionPassword()
    {
        return $this->render('password');
    }

    public function actionSubscription()
    {
        return $this->render('subscription');
    }

}
