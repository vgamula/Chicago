<?php

namespace app\models;

use app\components\ProjectQuery;
use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;
use voskobovich\behaviors\ManyToManyBehavior;
use yii\helpers\HtmlPurifier;

/**
 * This is the model class for table "{{%projects}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $alias
 * @property string $shortDescription
 * @property string $description
 * @property integer $isPublished
 * @property integer $rating
 * @property integer $createdAt
 * @property integer $updatedAt
 *
 * @property News[] $news
 * @property User[] $users
 * @property Topic[] $topics
 * @property Topic[] $projectTopics
 */
class ProjectSearch extends Project
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description', 'shortDescription', 'isPublished', 'projectTopics'], 'safe'],
            [['title', 'alias'], 'string', 'max' => 255],
            [['description'], 'string'],
        ];
    }
}
