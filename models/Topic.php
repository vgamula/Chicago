<?php

namespace app\models;

use nullref\useful\DropDownTrait;
use Yii;

/**
 * This is the model class for table "{{%topics}}".
 *
 * @property integer $id
 * @property string $title
 */
class Topic extends \yii\db\ActiveRecord
{
    use DropDownTrait;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%topics}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('topic', 'ID'),
            'title' => Yii::t('topic', 'Title'),
        ];
    }
}
