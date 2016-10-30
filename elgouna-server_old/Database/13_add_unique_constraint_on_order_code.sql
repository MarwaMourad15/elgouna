ALTER TABLE `orders` 
CHANGE `order_code` `order_code` VARCHAR(250) NOT NULL;

ALTER TABLE `orders` 
ADD CONSTRAINT `UC_ocode` UNIQUE (`order_code`);