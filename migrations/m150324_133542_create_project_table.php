<?php

use yii\db\Schema;
use yii\db\Migration;

class m150324_133542_create_project_table extends Migration
{
    protected $tableName = '{{%projects}}';

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable($this->tableName, [
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . ' NOT NULL',
            'alias' => Schema::TYPE_STRING . ' NOT NULL',
            'shortDescription' => Schema::TYPE_TEXT,
            'description' => Schema::TYPE_TEXT,
            'isPublished' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
            'rating' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
            'countryId' => Schema::TYPE_INTEGER,
            'regionId' => Schema::TYPE_INTEGER,
            'cityId' => Schema::TYPE_INTEGER,
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
