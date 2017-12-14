<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%chat}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $send_user_id
 * @property string $message
 * @property string $create_date
 * @property integer $is_read
 */
class Chat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%chat}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'send_user_id'], 'required'],
            [['user_id', 'send_user_id', 'is_read'], 'integer'],
            [['message'], 'string'],
            [['create_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'send_user_id' => Yii::t('app', 'Send User ID'),
            'message' => Yii::t('app', 'Message'),
            'create_date' => Yii::t('app', 'Create Date'),
            'is_read' => Yii::t('app', 'Is Read'),
        ];
    }
}
