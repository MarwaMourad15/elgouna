ALTER TABLE `venues` 
ADD `venueUsername` VARCHAR(30) NOT NULL AFTER `id`, 
ADD `venuePass` VARCHAR(50) NOT NULL AFTER `venueUsername`, 
ADD `merchant_id` MEDIUMINT(20) NOT NULL,
ADD `secure_hash` VARCHAR(500) NOT NULL;