ALTER TABLE `booking_link` 
ADD `snapchat` VARCHAR(500) NOT NULL AFTER `elgounaemail`;

ALTER TABLE `booking_link` 
CHANGE `snapchat` `snapchatURL` VARCHAR(500) AFTER `instagramURL`;