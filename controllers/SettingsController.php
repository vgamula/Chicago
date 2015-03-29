<?php

namespace app\controllers;

use app\models\User;
use Yii;
use yii\filters\AccessControl;

class SettingsController extends \yii\web\Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules'=>[
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ]
            ]
        ];
    }

    public function actionEmail()
    {
        $model = $this->findModel();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('info', Yii::t('app', 'Data was successfully updated'));
        }
        return $this->render('email', [
            'model' => $model,
        ]);
    }

    public function actionPassword()
    {
        $model = $this->findModel();
        $model->scenario = User::SCENARIO_SET_PASSWORD;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('info', Yii::t('app', 'Data was successfully updated'));
        }
        return $this->render('password', [
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
