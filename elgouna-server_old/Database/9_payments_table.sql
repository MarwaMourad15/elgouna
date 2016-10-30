CREATE TABLE `payments` ( 
`id` MEDIUMINT(20) NOT NULL AUTO_INCREMENT , 
`amount` DOUBLE(10,2) NOT NULL , 
`payment_date` DATETIME NOT NULL , 
`card_ending_with` VARCHAR(4) NOT NULL , 
`venue_name` VARCHAR(100) NOT NULL , 
`paymob_ref` VARCHAR(500) NOT NULL , 
`user_id` MEDIUMINT(20) NOT NULL , 
`order_id` MEDIUMINT(20) NOT NULL , 
PRIMARY KEY (`id`)
) 
ENGINE = InnoDB;