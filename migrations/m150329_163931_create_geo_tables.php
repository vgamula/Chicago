<?php

use yii\db\Schema;
use yii\db\Migration;

class m150329_163931_create_geo_tables extends Migration
{
    public function up()
    {
        $fileContent = file_get_contents(Yii::getAlias('@app/data') . '/geo.sql');
        $queries = explode(';', $fileContent);
        foreach ($queries as $item) {
            try {
                $this->execute($item . "");
            } catch (Exception $e) {
                echo "Error in: '{$item}'";
            }
        }
    }

    public function down()
    {
        $this->dropTable('_cities');
        $this->dropTable('_regions');
        $this->dropTable('_countries');
        return true;
    }

}
