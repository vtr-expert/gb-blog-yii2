<?php

use yii\db\Migration;

class m160302_174338_add_field_image extends Migration
{
    public function safeUp()
    {
        $this->execute("
            ALTER TABLE blg_blog ADD COLUMN image VARCHAR(255) AFTER description;
        ");
    }
    
    public function safeDown()
    {
        $this->execute("
            ALTER TABLE blg_blog DROP COLUMN image;
        ");
    }
}
