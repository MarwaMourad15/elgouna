CREATE TABLE IF NOT EXISTS `venues` (
  `id` mediumint(20) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100)  NOT NULL,
  `type` VARCHAR(15)  NOT NULL,
  `location` VARCHAR(200)  NOT NULL,
  `longitude` DOUBLE(10,2)  NOT NULL,
  `latitude` DOUBLE(10,2)  NOT NULL,
  `reviewScore` DOUBLE(3,2) NOT NULL,
  `ratingStar` tinyint(5) NOT NULL,
  `offerCheck` tinyint(1) NOT NULL,
  `offerTitle` VARCHAR(200) NULL,
  `offerDescription` VARCHAR(1000) NULL,
  `wifiCheck` tinyint(1) NULL NOT NULL,
  `visaCheck` tinyint(1) NOT NULL,
  `diningCheck` tinyint(1) NOT NULL,
  `elgounaVoice` VARCHAR(50)  NOT NULL,
  `email` VARCHAR(100)  NOT NULL,
  `phoneNumber` VARCHAR(50)  NOT NULL,
  `info` VARCHAR(100)  NOT NULL,
  `facebookLink` VARCHAR(200)  NOT NULL,
  `twitterLink` VARCHAR(200)  NOT NULL,
  `instagramLink` VARCHAR(200)  NOT NULL,
  `youtubeLink` VARCHAR(200)  NOT NULL,
  `ord` smallint(50) NOT NULL,
  `hidden` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) 
ENGINE = InnoDB 
AUTO_INCREMENT = 12 DEFAULT 
CHARSET = latin1
