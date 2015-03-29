<?php
/**
 * @author    Dmytro Karpovych
 */

namespace app\components;

use app\models\Project;
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

    /**
     * Find with special slug
     * @param $slug
     * @return static
     */
    public function bySlug($slug)
    {
        return $this->andWhere(['alias' => $slug]);
    }

    /**
     * Find only active projects
     * @return static
     */
    public function published()
    {
        return $this->andWhere(['isPublished' => Project::PUBLISHED]);
    }
} 