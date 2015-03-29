<?php

namespace app\models;

use app\components\ProjectQuery;
use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use voskobovich\behaviors\ManyToManyBehavior;

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
            [['projectTopics'], 'safe'],
            [['title', 'description', 'shortDescription', 'isPublished'], 'required'],
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
            [
                'class' => ManyToManyBehavior::className(),
                'relations' => [
                    'projectTopics' => 'topics'
                ]
            ]
        ]);
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
    public function getTopics()
    {
        return $this->hasMany(Topic::className(), ['id' => 'topicId'])
            ->viaTable(ProjectTopic::tableName(), ['projectId' => 'id']);
    }

    /**
     * Get array of all subscribers
     * @return array
     */
    public function getUsersEmails()
    {
        //@TODO implements it
        return [];
    }
}
