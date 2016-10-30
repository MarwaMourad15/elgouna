ALTER TABLE orders ADD column venue_id mediumint(20);

-- ADD
ALTER TABLE `orders` 
ADD CONSTRAINT `fk_venueId_orders` 
FOREIGN KEY (`venue_id`) 
REFERENCES `venues`(`id`) 
ON DELETE CASCADE
ON UPDATE CASCADE;

-- DROP
ALTER TABLE `orders` DROP FOREIGN KEY `fk_venueId_orders`;

-- ADD
ALTER TABLE `venues_img` 
ADD CONSTRAINT `fk_venueId_imgs` 
FOREIGN KEY (`venue_id`) 
REFERENCES `venues`(`id`) 
ON DELETE CASCADE 
ON UPDATE RESTRICT;
