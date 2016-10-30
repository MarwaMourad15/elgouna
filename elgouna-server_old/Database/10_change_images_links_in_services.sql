update services set img =  SUBSTRING_INDEX(img, '/', -1);
update hotels_img set img = '1.jpg';
