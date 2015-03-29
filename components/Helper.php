<?php
/**
 * @author    Dmytro Karpovych
 */

namespace app\components;

use app\models\User;
use Yii;

class Helper
{
    /**
     * Get simple list of 'yes' and 'no' items
     * @return array
     */
    public static function YesNoList()
    {
        return [
            1 => Yii::t('app', 'Yes'),
            0 => Yii::t('app', 'No'),
        ];
    }

    public static function getRoles()
    {
        return [
            User::ROLE_USER => Yii::t('user', 'User'),
            User::ROLE_ADMIN => Yii::t('user', 'Admin'),
        ];
    }
} 