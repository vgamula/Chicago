<?php
/**
 * @author    Serhiy Vinichuk <serhiyvinichuk@gmail.com>
 * @copyright 2015 AtNiwe
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */


namespace app\components;


use app\models\messages\Message;
use app\models\User;
use app\models\UserOption;
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\i18n\Formatter;

class AppFormatter extends Formatter
{
    public function asRole($role)
    {
        return isset(Helper::getRoles()[$role]) ? Helper::getRoles()[$role] : \Yii::t('app', 'N/A');
    }

} 