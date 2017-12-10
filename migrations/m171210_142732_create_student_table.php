<?php

use yii\db\Migration;

/**
 * Handles the creation of table `student`.
 */
class m171210_142732_create_student_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        if(Yii::$app->db->schema->getTableSchema('{{%student}}') === null){
            $this->createTable('{{%student}}', [
                'user_id' => $this->primaryKey(),
                'name'=> $this->string(100),
                'surname'=> $this->string(100),
                'parent_name'=> $this->string(100),
                'birth_date'=> $this->date(),
                'faculty'=> $this->string(100),
                'department'=> $this->string(100),
                'group'=> $this->string(100),
                'enter_year'=> $this->string(4),
            ]);
        }

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%student}}');
    }
}
