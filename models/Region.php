<?php

namespace app\models;

use nullref\useful\DropDownTrait;
use Yii;

/**
 * This is the model class for table "{{%_regions}}".
 *
 * @property integer $regionId
 * @property integer $countryId
 * @property string $title
 */
class Region extends \yii\db\ActiveRecord
{
    use DropDownTrait;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%_regions}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['regionId', 'countryId'], 'integer'],
            [['title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'regionId' => Yii::t('geo', 'Region ID'),
            'countryId' => Yii::t('geo', 'Country ID'),
            'title' => Yii::t('geo', 'Title'),
        ];
    }
}
