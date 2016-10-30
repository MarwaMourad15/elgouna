CREATE TABLE `user-card` ( 
`id` MEDIUMINT NOT NULL AUTO_INCREMENT , 
`user_id` MEDIUMINT NOT NULL , 
`card_ending_with` VARCHAR(4) NOT NULL , 
`adding_date` DATE NOT NULL , 
`paymob_token` VARCHAR(500) NOT NULL , 
PRIMARY KEY (`id`), 
INDEX `user_ref` (`user_id`)
) 
ENGINE = InnoDB;