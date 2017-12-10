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
            Yii::$app->db->createCommand("CREATE TABLE {{%chat}} (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `userId` INT(11) DEFAULT NULL,
  `message` TEXT,
  `updateDate` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=INNODB;
")->execute();
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
