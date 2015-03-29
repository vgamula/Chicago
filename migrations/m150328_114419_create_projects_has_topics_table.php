<?php

use yii\db\Schema;
use yii\db\Migration;

class m150328_114419_create_projects_has_topics_table extends Migration
{
    protected $tableName = '{{%projects_has_topics}}';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable($this->tableName, [
            'projectId' => Schema::TYPE_INTEGER,
            'topicId' => Schema::TYPE_INTEGER,
            'PRIMARY KEY (`projectId`, `topicId`)'
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable($this->tableName);
        return true;
    }
}
