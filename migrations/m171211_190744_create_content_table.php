<?php

use yii\db\Migration;

/**
 * Handles the creation of table `content`.
 */
class m171211_190744_create_content_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        if(Yii::$app->db->getTableSchema('{{%content}}') === null){
            $this->createTable('{{%content}}', [
                'id'              => $this->primaryKey(),
                'title_uk'        => $this->string(50),
                'text_full_uk'    => $this->text(),
                'text_short_uk'   => $this->string(500),
                'title_en'        => $this->string(50),
                'text_full_en'    => $this->text(),
                'text_short_en'   => $this->string(500),
                'create_date'     => $this->dateTime(),
                'order'           => $this->integer(),
                'is_published'    => $this->smallInteger(1)->defaultValue(0)
            ]);
        }

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%content}}');
    }
}
