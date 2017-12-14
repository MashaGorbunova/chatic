<?php

namespace app\models;

use Yii;
use yii\db\Expression;

/**
 * This is the model class for table "{{%content}}".
 *
 * @property integer $id
 * @property string $title_uk
 * @property string $text_short_uk
 * @property string $text_full_uk
 * @property string $title_en
 * @property string $text_short_en
 * @property string $text_full_en
 * @property string $create_date
 * @property integer $order
 * @property integer $is_published
 */
class Content extends \yii\db\ActiveRecord
{
    const CONTENT_SHORT = 'short';
    const CONTENT_FULL = 'full';


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%content}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text_full_uk', 'text_full_en'], 'string'],
            [['create_date'], 'safe'],
            [['order', 'is_published'], 'integer'],
            [['title_uk', 'title_en'], 'string', 'max' => 50],
            [['text_short_uk', 'text_short_en'], 'string', 'max' => 500],
            [['text_full_uk', 'text_full_en', 'order', 'title_uk', 'title_en', 'text_short_uk', 'text_short_en'], 'required']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title_uk' => Yii::t('app', 'Title'),
            'text_short_uk' => Yii::t('app', 'Text Short'),
            'text_full_uk' => Yii::t('app', 'Text Full'),
            'title_en' => Yii::t('app', 'Title'),
            'text_short_en' => Yii::t('app', 'Text Short'),
            'text_full_en' => Yii::t('app', 'Text Full'),
            'create_date' => Yii::t('app', 'Create Date'),
            'order' => Yii::t('app', 'Order'),
            'is_published' => Yii::t('app', 'Is Published'),
        ];
    }

    public function beforeSave($insert)
    {
        $this->create_date = new Expression('NOW()');
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }
}
