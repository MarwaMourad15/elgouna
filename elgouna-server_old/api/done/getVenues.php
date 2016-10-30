<?php

include("db_conn.php");
$venues_json = array();
$venue_json = array();
$venues_query = mysql_query("select * "
        . "from venues");
if($venues_query) {
    
    $venues_rows = mysql_num_rows($venues_query);
    if($venues_rows > 0) {
        
        while($venue_arr = mysql_fetch_assoc($venues_query)) {
            
            $venue_json['id'] = $venue_arr['id'];
            $venue_json['username'] = $venue_arr['venueUsername'];
            $venue_json['password'] = $venue_arr['venuePass'];
            $venue_json['name'] = $venue_arr['name'];
            $venue_json['type'] = $venue_arr['type'];
            $venue_json['location'] = $venue_arr['location'];
            $venue_json['longitude'] = $venue_arr['longitude'];
            $venue_json['latitude'] = $venue_arr['latitude'];
            $venue_json['review'] = $venue_arr['reviewScore'];
            $venue_json['rating'] = $venue_arr['ratingStar'];
            $venue_json['description'] = $venue_arr['description'];
            $venue_json['offerCheck'] = $venue_arr['offerCheck'];
            $venue_json['offerTitle'] = $venue_arr['offerTitle'];
            $venue_json['offerDescription'] = $venue_arr['offerDescription'];
            $venue_json['wifiCheck'] = $venue_arr['wifiCheck'];
            $venue_json['visaCheck'] = $venue_arr['visaCheck'];
            $venue_json['diningCheck'] = $venue_arr['diningCheck'];
            $venue_json['elgounaVoice'] = $venue_arr['elgounaVoice'];
            $venue_json['email'] = $venue_arr['email'];
            $venue_json['phoneNumber'] = $venue_arr['phoneNumber'];
            $venue_json['info'] = $venue_arr['info'];
            $venue_json['facebookLink'] = $venue_arr['facebookLink'];
            $venue_json['twitterLink'] = $venue_arr['twitterLink'];
            $venue_json['instagramLink'] = $venue_arr['instagramLink'];
            $venue_json['youtubeLink'] = $venue_arr['youtubeLink'];
            $venue_json['order'] = $venue_arr['ord'];
            $venue_json['merchantId'] = $venue_arr['merchant_id'];
            $venue_json['secureHash'] = $venue_arr['secure_hash'];
            $venue_json['images'] = array();
            $venue_id = $venue_arr['id'];
            $venue_imgs_query = mysql_query("select * "
                    . "from venues_img "
                    . "where venue_id = '$venue_id'");
            if($venue_imgs_query) {
                
                $venue_imgs_rows = mysql_num_rows($venue_imgs_query);
                if($venue_imgs_rows > 0) {
                    
                    while($venue_img_arr = mysql_fetch_assoc($venue_imgs_query)) {
                        
                        $venue_img = $venue_img_arr['img'];
                        $venue_json['images'][] = $venue_img;
                    }
                }
                else {
                    
                    $venue_json['images'] = array();
                }
                
            }
            else {
                
                $venues_json['images'] = mysql_error();
            }
            $venues_json['venues'][] = $venue_json;
        }
    }
    else {

        $venues_json[] = [];
    }
}
else {
    
    $venues_json[] = mysql_error();
}
echo json_encode($venues_json, JSON_UNESCAPED_SLASHES);

?>
