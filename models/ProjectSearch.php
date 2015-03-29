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
    public $projectTopics = [];

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description', 'shortDescription', 'isPublished', 'projectTopics', 'countryId', 'regionId', 'cityId'], 'safe'],
            [['title', 'alias'], 'string', 'max' => 255],
            [['description'], 'string'],
        ];
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {

        $query = Project::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'cityId' => $this->cityId,
            'regionId' => $this->regionId,
            'countryId' => $this->countryId,
        ]);

        $text = explode(' ', $this->title);
        foreach ($text as $word) {
            $query->andFilterWhere(['like', 'title', $word]);
        }

        for ($i = 0; $i < count($this->projectTopics); $i++) {
            $id = $this->projectTopics[$i];
            $tableName = 'topics' . $i;
            $query->innerJoin(ProjectTopic::tableName() . ' as ' . $tableName,
                "({$tableName}.projectId = projects.id) AND ({$tableName}.topicId = :topicId{$i})",
                [':topicId' . $i => $id]);
        }

        return $dataProvider;
    }
}
