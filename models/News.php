<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%news}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $projectId
 * @property integer $createdAt
 * @property integer $updatedAt
 */
class News extends \yii\db\ActiveRecord
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
            [['title', 'projectId', 'createdAt', 'updatedAt'], 'required'],
            [['description'], 'string'],
            [['projectId', 'createdAt', 'updatedAt'], 'integer'],
            [['title'], 'string', 'max' => 255]
        ];
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
            'projectId' => Yii::t('news', 'Project ID'),
            'createdAt' => Yii::t('news', 'Created At'),
            'updatedAt' => Yii::t('news', 'Updated At'),
        ];
    }
}
