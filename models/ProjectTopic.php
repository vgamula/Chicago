<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%projects_has_topics}}".
 *
 * @property integer $projectId
 * @property integer $topicId
 *
 * @property Project $project
 * @property Topic $topic
 */
class ProjectTopic extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%projects_has_topics}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['projectId', 'topicId'], 'required'],
            [['projectId', 'topicId'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'projectId' => Yii::t('topic', 'Project ID'),
            'topicId' => Yii::t('topic', 'Topic ID'),
        ];
    }
}
