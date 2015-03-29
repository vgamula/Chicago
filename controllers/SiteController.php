<?php

namespace app\controllers;

use app\models\Project;
use app\models\ProjectSearch;
use app\models\ProjectUser;
use Yii;
use yii\base\InvalidParamException;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\NotFoundHttpException;
use yii\web\User;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Subscribe current user to project by id
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionSubscribe($id)
    {
        /** @var Project $project */
        $project = Project::findOne($id);
        /** @var User $user */
        $user = Yii::$app->user->identity;
        if (!isset($project) || ProjectUser::find(['projectId' => $project->id, 'userId' => $user->id])->exists()) {
            throw new NotFoundHttpException(Yii::t('app', 'Page not found'));
        }
        $relation = new ProjectUser(['projectId' => $project->id, 'userId' => $user->id]);
        $relation->save(false);

        return $this->redirect(['/site/view', 'slug' => $project->alias]);
    }

    /**
     * Unsubscribe current user from project by id
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionUnsubscribe($id)
    {
        /** @var Project $project */
        $project = Project::findOne($id);
        /** @var User $user */
        $user = Yii::$app->user->identity;
        /** @var ProjectUser $relation */
        $relation = ProjectUser::findOne(['projectId' => $project->id, 'userId' => $user->id]);
        if (!isset($project) || !isset($relation)) {
            throw new NotFoundHttpException(Yii::t('app', 'Page not found'));
        }
        $relation->delete();

        return $this->redirect(['/site/view', 'slug' => $project->alias]);
    }

    public function actionSearch()
    {
        $model = new ProjectSearch();
        if ($dataProvider = $model->search(Yii::$app->request->get())) {
            return $this->render('search', [
                'model' => $model,
                'dataProvider' => $dataProvider
            ]);
        }
        throw new NotFoundHttpException(Yii::t('app', 'Page not found'));
    }

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider(['query' => Project::find()->popular()->published()]);
        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionView($slug)
    {
        $model = Project::find()->bySlug($slug)->published()->one();
        if (!isset($model)) {
            throw new NotFoundHttpException(Yii::t('app', 'Page not found'));
        }
        return $this->render('view', ['model' => $model]);
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
