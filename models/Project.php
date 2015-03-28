<?php

namespace app\models;

use app\components\ProjectQuery;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%projects}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $shortDescription
 * @property string $description
 * @property integer $status
 * @property integer $rating
 * @property integer $createdAt
 * @property integer $updatedAt
 */
class Project extends ActiveRecord
{
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
            [['title', 'description', 'shortDescription', 'status'], 'required'],
            [['title'], 'string', 'max' => 255],
            [['description'], 'string'],
            [['status', 'createdAt', 'updatedAt'], 'integer'],
        ];
    }

    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            [
                'class' => 'yii\behaviors\TimestampBehavior',
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
            'id' => Yii::t('project', 'ID'),
            'title' => Yii::t('project', 'Title'),
            'description' => Yii::t('project', 'Description'),
            'status' => Yii::t('project', 'Status'),
            'createdAt' => Yii::t('project', 'Created At'),
            'updatedAt' => Yii::t('project', 'Updated At'),
        ];
    }

    /**
     * @return object|\yii\db\ActiveQuery
     * @throws \yii\base\InvalidConfigException
     */
    public static function find()
    {
        return Yii::createObject(ProjectQuery::className(), [get_called_class()]);
    }
}
