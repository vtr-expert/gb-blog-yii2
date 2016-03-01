<?php

use yii\db\Migration;

class m160301_170630_create_table_blog extends Migration
{
    public function safeUp()
    {
        $this->execute(
            "CREATE TABLE `blg_blog` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `user_id` int(11) NOT NULL,
                `description` varchar(255) NOT NULL,
                `article` text NOT NULL,
                `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (`id`),
                INDEX `fk_blg_blog_1_idx` (`user_id` ASC),
                CONSTRAINT `fk_blg_blog_1` 
                    FOREIGN KEY (`user_id`) 
                    REFERENCES `blg_user` (`id`) 
                    ON DELETE NO ACTION 
                    ON UPDATE NO ACTION                
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;"            
        );        
    }

    public function safeDown()
    {
        $this->execute(
            "DROP TABLE IF EXISTS `blg_blog`"
        );
    }
}
