<?php

namespace app\models;

use nullref\useful\DropDownTrait;
use Yii;

/**
 * This is the model class for table "{{%_countries}}".
 *
 * @property integer $countryId
 * @property string $title
 */
class Country extends \yii\db\ActiveRecord
{
    use DropDownTrait;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%_countries}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['countryId'], 'integer'],
            [['title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'countryId' => Yii::t('geo', 'Country ID'),
            'title' => Yii::t('geo', 'Title'),
        ];
    }
}
