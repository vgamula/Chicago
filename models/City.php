<?php

namespace app\models;

use nullref\useful\DropDownTrait;
use Yii;

/**
 * This is the model class for table "{{%_cities}}".
 *
 * @property integer $cityId
 * @property integer $countryId
 * @property integer $regionId
 * @property string $title
 */
class City extends \yii\db\ActiveRecord
{
    use DropDownTrait;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%_cities}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cityId', 'countryId', 'regionId'], 'integer'],
            [['title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cityId' => Yii::t('geo', 'City ID'),
            'countryId' => Yii::t('geo', 'Country ID'),
            'regionId' => Yii::t('geo', 'Region ID'),
            'title' => Yii::t('geo', 'Title'),
        ];
    }
}
