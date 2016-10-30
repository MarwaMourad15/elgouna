-- DROP
ALTER TABLE `orders` DROP FOREIGN KEY `fk_venueId_orders`;

-- ADD
ALTER TABLE `orders` 
ADD CONSTRAINT `fk_venueId_orders` 
FOREIGN KEY (`venue_id`) 
REFERENCES `venues`(`id`) 
ON DELETE SET NULL
ON UPDATE CASCADE;