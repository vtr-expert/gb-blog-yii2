<?php

use yii\db\Migration;

class m160301_164311_create_table_user extends Migration
{
    public function safeUp()
    {
        $this->execute(
            "CREATE TABLE IF NOT EXISTS `blg_user` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `username` varchar(128) NOT NULL,
                `surname` varchar(45) NOT NULL,
                `name` varchar(45) NOT NULL,
                `password` varchar(255) NOT NULL,
                `salt` varchar(255) NOT NULL,
                `auth_key` varchar(255) NOT NULL,
                `access_token` varchar(255) NULL DEFAULT NULL,
                `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (`id`),
                UNIQUE INDEX `username_UNIQUE` (`username` ASC)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;"
        );        
    }

    public function safeDown()
    {
        $this->execute(
            "DROP TABLE IF EXISTS `blg_user`"
        );
    }
    
}
