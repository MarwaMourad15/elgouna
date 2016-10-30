ALTER TABLE `booking_link` 
CHANGE `about` `about` VARCHAR(50000) 
CHARACTER SET latin1 
COLLATE latin1_swedish_ci 
NULL 
DEFAULT NULL;

ALTER TABLE `venues` 
CHANGE `description` `description` VARCHAR(50000) 
CHARACTER SET latin1 
COLLATE latin1_swedish_ci 
NULL 
DEFAULT NULL;

ALTER TABLE `venues` 
CHANGE `offerDescription` `offerDescription` VARCHAR(50000) 
CHARACTER SET latin1 
COLLATE latin1_swedish_ci 
NULL 
DEFAULT NULL;