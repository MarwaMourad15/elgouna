CREATE TABLE IF NOT EXISTS `orders` ( 
`id` MEDIUMINT NOT NULL AUTO_INCREMENT , 
`order_code` VARCHAR(500) NOT NULL , 
`amount` DOUBLE(10,2) NOT NULL , 
`creation_date` DATE NOT NULL , 
`paidAmount` DOUBLE(10,2) NULL , 
`closed` TINYINT(1) NOT NULL , 
`closure_date` DATE NULL , 
`last_payment_date` DATETIME NULL , 
`venueName` VARCHAR(100) NOT NULL , 
`venueImage` VARCHAR(200) NOT NULL , 
PRIMARY KEY (`id`)
) 
ENGINE = InnoDB;