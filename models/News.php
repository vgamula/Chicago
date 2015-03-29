<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\HtmlPurifier;

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
 *
 * @property Project $project
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
            [['title'], 'string', 'max' => 255],
            [['description'], function ($attribute) {
                $this->$attribute = HtmlPurifier::process($this->$attribute);
            }],
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
            'id' => Yii::t('news', 'ID'),
            'title' => Yii::t('news', 'Title'),
            'description' => Yii::t('news', 'Description'),
            'isSent' => Yii::t('news', 'Is Sent'),
            'projectId' => Yii::t('news', 'Project ID'),
            'createdAt' => Yii::t('news', 'Created At'),
            'updatedAt' => Yii::t('news', 'Updated At'),
        ];
    }

    /**
     * Sent messages if new record
     * @param bool $insert
     * @param array $changedAttributes
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        if ($insert && $this->isSent) {
            $this->sendEmail();
        }
    }

    /**
     * Get related project
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::tableName(), ['id' => 'projectId']);
    }

    /**
     * Send e-mail to project subscribers
     */
    public function sendEmail()
    {
        //@TODO implement it
        Yii::$app->mailer->compose('news', ['model' => $this])
            ->setTo($this->project->getUsersEmails())
            ->setFrom('')
            ->setSubject($this->title)
            ->send();
    }
}
