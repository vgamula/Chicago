<?php
namespace app\commands;

use Yii;
use yii\console\Controller;
use \app\rbac\UserRule;

class RbacController extends Controller
{
    public function actionInit()
    {
        $authManager = \Yii::$app->authManager;

        $user = $authManager->createRole(UserRule::ROLE_USER);
        $admin = $authManager->createRole(UserRule::ROLE_ADMIN);

        $userRule = new UserRule();
        $authManager->add($userRule);

        $user->ruleName = $userRule->name;
        $admin->ruleName = $userRule->name;

        $authManager->add($user);
        $authManager->add($admin);

        $authManager->addChild($admin, $user);
    }
}