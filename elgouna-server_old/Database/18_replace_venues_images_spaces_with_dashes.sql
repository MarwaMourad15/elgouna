-- Replace all occurrences of white spaces in image names with dashes
update `venues_img` 
SET `img` = REPLACE(`img`, ' ', '-');