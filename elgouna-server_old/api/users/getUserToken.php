<?php 

    $user = new stdClass();
    $user->access_token = "adsajdfhiusdfhjksfhsdfjsdf";
    $user->token_type = "client_credentials";
    $user->expires_in = 2800;
    echo json_encode($user);
    
?>