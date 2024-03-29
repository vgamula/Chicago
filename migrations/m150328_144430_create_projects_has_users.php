<?php

use yii\db\Schema;
use yii\db\Migration;

class m150328_144430_create_projects_has_users extends Migration
{
    protected $tableName = '{{%projects_has_users}}';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable($this->tableName, [
            'projectId' => Schema::TYPE_INTEGER,
            'userId' => Schema::TYPE_INTEGER,
            'PRIMARY KEY (`projectId`, `userId`)'
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable($this->tableName);
        return true;
    }
}
