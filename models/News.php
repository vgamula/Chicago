<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%news}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $isSent
 * @property integer $projectId
 * @property integer $createdAt
 * @property integer $updatedAt
 */
class News extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%news}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'isSent', 'projectId', 'description'], 'required'],
            [['isSent', 'projectId', 'createdAt', 'updatedAt'], 'integer'],
            [['isSent'], 'default', 'value' => true],
            [['title'], 'string', 'max' => 255]
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
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('topic', 'ID'),
            'title' => Yii::t('topic', 'Title'),
            'description' => Yii::t('topic', 'Description'),
            'isSent' => Yii::t('topic', 'Is Sent'),
            'projectId' => Yii::t('topic', 'Project ID'),
            'createdAt' => Yii::t('topic', 'Created At'),
            'updatedAt' => Yii::t('topic', 'Updated At'),
        ];
    }

    /**
     * Get related project
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::tableName(), ['id' => 'projectId']);
    }

    public function sendEmail()
    {
        //@TODO implement it
    }
}
