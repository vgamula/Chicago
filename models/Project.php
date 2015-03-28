<?php

namespace app\models;

use app\components\ProjectQuery;
use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

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
 * @property ProjectTopic[] $projectTopics
 */
class Project extends ActiveRecord
{
    /**
     * Statuses
     */
    const PUBLISHED = 1;
    const UNPUBLISHED = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%projects}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description', 'shortDescription', 'isPublished', 'topics'], 'required'],
            [['title', 'alias'], 'string', 'max' => 255],
            [['description'], 'string'],
            [['isPublished', 'createdAt', 'updatedAt'], 'integer'],
        ];
    }

    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'createdAt',
                'updatedAtAttribute' => 'updatedAt',
            ],
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
                'slugAttribute' => 'alias',
            ],
        ]);
    }

    public function afterSave($insert, $changedAttributes)
    {
/*        $oldTopics = [];
        foreach ($this->projectTopics as $topic) {
            $oldTopics[$topic->topicId] = $topic;
        }

        $newTopics = [];
        foreach ($this->topics as $topicId) {
            $newTopics[$topicId] = new ProjectTopic(['projectId' => $this->id, 'topicId' => $topicId]);
        }*/
        /** @var ProjectTopic[] $removed */
      //  $removed = array_diff_key($oldTopics, $newTopics);
        /** @var ProjectTopic[] $added */
       /* $added = array_diff_key($newTopics, $oldTopics);
        foreach ($added as $item) {
            $item->link('project', $this);
        }
        foreach ($removed as $item) {
            $item->delete();
        }*/

        parent::afterSave($insert, $changedAttributes);
    }

    public function afterFind()
    {
        parent::afterFind();
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('project', 'ID'),
            'title' => Yii::t('project', 'Title'),
            'description' => Yii::t('project', 'Description'),
            'topics' => Yii::t('project', 'Topics'),
            'isPublished' => Yii::t('project', 'Is Published'),
            'createdAt' => Yii::t('project', 'Created At'),
            'updatedAt' => Yii::t('project', 'Updated At'),
        ];
    }

    /**
     * @return ProjectQuery
     * @throws \yii\base\InvalidConfigException
     */
    public static function find()
    {
        return Yii::createObject(ProjectQuery::className(), [get_called_class()]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectTopics()
    {
        return $this->hasMany(ProjectTopic::className(), ['projectId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTopics()
    {
        return $this->hasMany(Topic::className(), ['id' => 'topicId'])
            ->viaTable(ProjectTopic::tableName(), ['projectId' => 'id']);
    }

    public function setTopics()
    {
        return [];
    }

}
