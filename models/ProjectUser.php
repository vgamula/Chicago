<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%projects_has_users}}".
 *
 * @property integer $projectId
 * @property integer $userId
 */
class ProjectUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%projects_has_users}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['projectId', 'userId'], 'required'],
            [['projectId', 'userId'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'projectId' => Yii::t('project', 'Project ID'),
            'userId' => Yii::t('project', 'User ID'),
        ];
    }
}
