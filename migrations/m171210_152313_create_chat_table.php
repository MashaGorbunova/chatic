<?php

use yii\db\Migration;

/**
 * Handles the creation of table `chat`.
 */
class m171210_152313_create_chat_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        if(Yii::$app->db->getTableSchema('{{%chat}}') === null){
            $this->createTable('{{%chat}}', [
                'id' => $this->primaryKey(),
                'user_id' => $this->integer()->notNull(),
                'send_user_id' => $this->integer()->notNull(),
                'message' => $this->text(),
                'create_date' => $this->dateTime(),
                'is_read' => $this->smallInteger(1)->defaultValue(0)
            ]);
        }
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%chat}}');
    }
}
