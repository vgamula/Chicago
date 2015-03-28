<?php
/**
 * @author    Dmytro Karpovych
 */

namespace app\components;

use yii\db\ActiveQuery;

class ProjectQuery extends ActiveQuery
{
    /**
     * Find most popular projects
     * @param int $limit
     * @return static
     */
    public function popular($limit = 3)
    {
        return $this->limit($limit)->orderBy('rating');
    }
} 