<?php
/**
 * @author    Dmytro Karpovych
 */

namespace app\components;

use Yii;

class Helper
{
    /**
     * Get simple list of 'yes' and 'no' items
     * @return array
     */
    public static function YseNoList()
    {
        return [
            0 => Yii::t('app', 'Yes'),
            1 => Yii::t('app', 'No'),
        ];
    }
} 