<?php

use yii\db\Schema;
use yii\db\Migration;

class m150328_084432_create_news_table extends Migration
{
    protected $tableName = '{{%news}}';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable($this->tableName, [
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . ' NOT NULL',
            'description' => Schema::TYPE_TEXT,
            'isSent' => Schema::TYPE_SMALLINT . ' NOT NULL',
            'projectId' => Schema::TYPE_INTEGER . ' NOT NULL',
            'createdAt' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updatedAt' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable($this->tableName);
        return true;
    }
}
