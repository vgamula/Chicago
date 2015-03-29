<?php
/**
 * @author    Dmytro Karpovych
 * @copyright 2015 AtNiwe
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
namespace app\rbac;

use app\models\User;
use Yii;
use yii\rbac\Rule;

class UserRule extends Rule
{
    /**
     * Roles
     */
    const ROLE_ADMIN = 'admin';
    const ROLE_USER = 'user';

    public $name = 'userRole';

    public function execute($user, $item, $params)
    {
        if (!\Yii::$app->user->isGuest) {
            $role = \Yii::$app->user->identity->role;
            switch ($item->name) {
                case self::ROLE_ADMIN:
                    return $role == User::ROLE_ADMIN;
                case self::ROLE_USER:
                    return $role == User::ROLE_USER || $role == User::ROLE_ADMIN;
            }
        }
        return false;
    }
}
