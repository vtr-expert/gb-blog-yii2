<?php

use yii\db\Migration;

class m160301_171915_create_table_comment extends Migration
{
    public function safeUp()
    {
        $this->execute(
            "CREATE TABLE `blg_comment` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `user_id` int(11) NOT NULL,
                `blog_id` int(11) NOT NULL,
                `comment` varchar(255) NOT NULL,
                `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (`id`),
                INDEX `fk_blg_comment_1_idx` (`user_id` ASC),
                CONSTRAINT `fk_blg_comment_1` 
                    FOREIGN KEY (`user_id`) 
                    REFERENCES `blg_user` (`id`) 
                    ON DELETE NO ACTION 
                    ON UPDATE NO ACTION,
                INDEX `fk_blg_comment_2_idx` (`blog_id` ASC),
                CONSTRAINT `fk_blg_comment_2` 
                    FOREIGN KEY (`blog_id`) 
                    REFERENCES `blg_blog` (`id`) 
                    ON DELETE NO ACTION 
                    ON UPDATE NO ACTION    
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;"           
        );        
    }

    public function safeDown()
    {
        $this->execute(
            "DROP TABLE IF EXISTS `blg_comment`"
        );
    }
}
