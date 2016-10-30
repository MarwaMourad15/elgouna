ALTER TABLE `transportation` 
CHANGE `description` `description` VARCHAR(50000) 
CHARACTER SET utf8 
COLLATE utf8_general_ci 
NOT NULL;
ALTER TABLE `venues` 
CHANGE `description` `description` VARCHAR(50000) 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_general_ci 
NULL 
DEFAULT NULL;
ALTER TABLE `venues` 
CHANGE `offerDescription` `offerDescription` VARCHAR(1000) 
CHARACTER SET utf8 
COLLATE utf8_general_ci 
NULL 
DEFAULT NULL;