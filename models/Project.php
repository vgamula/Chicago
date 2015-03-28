<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%projects}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $status
 * @property integer $createdAt
 * @property integer $updatedAt
 */
class Project extends \yii\db\ActiveRecord
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
            [['title', 'createdAt', 'updatedAt'], 'required'],
            [['description'], 'string'],
            [['status', 'createdAt', 'updatedAt'], 'integer'],
            [['title'], 'string', 'max' => 255]
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
}
