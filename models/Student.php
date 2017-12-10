<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%student}}".
 *
 * @property integer $user_id
 * @property string $name
 * @property string $surname
 * @property string $parent_name
 * @property string $birth_date
 * @property string $faculty
 * @property string $department
 * @property string $group
 * @property string $enter_year
 */
class Student extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%student}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['birth_date'], 'safe'],
            [['name', 'surname', 'parent_name', 'faculty', 'department', 'group'], 'string', 'max' => 100],
            [['enter_year'], 'string', 'max' => 4],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('app', 'User ID'),
            'name' => Yii::t('app', 'Name'),
            'surname' => Yii::t('app', 'Surname'),
            'parent_name' => Yii::t('app', 'Parent Name'),
            'birth_date' => Yii::t('app', 'Birth Date'),
            'faculty' => Yii::t('app', 'Faculty'),
            'department' => Yii::t('app', 'Department'),
            'group' => Yii::t('app', 'Group'),
            'enter_year' => Yii::t('app', 'Enter Year'),
        ];
    }
}
